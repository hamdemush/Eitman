<script>
(function checkAuthGuard() {
    const currentPath = window.location.pathname;
    const token = localStorage.getItem('auth_token');
    const userInfo = JSON.parse(localStorage.getItem('user_info') || '{}');

    // المسارات المحمية لكل دور
    const isPatientRoute = currentPath.startsWith('/patient');
    const isDoctorRoute  = currentPath.startsWith('/doctor');
    const isAdminRoute   = currentPath.startsWith('/admin');

    const isProtectedRoute = isPatientRoute || isDoctorRoute || isAdminRoute;

    // 1. إذا كان يحاول دخول صفحة محمية ولا يملك Token -> تحويل لصفحة الدخول
    if (isProtectedRoute && !token) {
        window.location.href = "{{ route('login') }}";
        return;
    }

    // 2. التحقق من الصلاحيات حسب نوع الحساب (Role Check)
    if (token && isProtectedRoute) {
        const userRole = userInfo.role;

        if (isPatientRoute && userRole !== 'patient') {
            redirectBasedOnRole(userRole);
        } else if (isDoctorRoute && (userRole !== 'doctor' && userRole !== 'psychologist')) {
            redirectBasedOnRole(userRole);
        } else if (isAdminRoute && userRole !== 'admin') {
            redirectBasedOnRole(userRole);
        }
    }

    // 3. إذا كان مسجل دخول بالفعل وحاول فتح صفحة الدخول أو التسجيل -> توجيهه للوحته مباشرة
    const isAuthPage = currentPath === '/login' || currentPath === '/register';
    if (token && isAuthPage) {
        redirectBasedOnRole(userInfo.role);
    }

    function redirectBasedOnRole(role) {
        if (role === 'admin') {
            window.location.href = "{{ route('admin.dashboard') }}";
        } else if (role === 'doctor' || role === 'psychologist') {
            window.location.href = "{{ route('doctor.dashboard') }}";
        } else {
            window.location.href = "{{ route('patient.dashboard') }}";
        }
    }
})();
</script>
<script>
function handleLogout() {
    const token = localStorage.getItem('auth_token');

    // إرسال طلب تسجيل الخروج للـ API
    fetch('/api/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).finally(() => {
        // تنظيف البيانات والتوجيه للرئيسية
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_info');
        window.location.href = "{{ route('home') }}";
    });
}
</script>