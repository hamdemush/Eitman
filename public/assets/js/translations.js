/* ==========================================================================
   FILE:      translations.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Central Arabic/English dictionary for the whole site.
   ----------------------------------------------------------------------
   HOW IT WORKS
   Every translatable element in the HTML gets a `data-i18n="some.key"`
   attribute. i18n.js reads that attribute and replaces the element's text
   with TRANSLATIONS[currentLang]["some.key"].

   Keys are namespaced by page/section (e.g. "nav.*", "home.*", "login.*")
   so it stays easy to find where a string is used and to add new pages
   without clashing with existing keys.

   NOTE: this file currently covers the shared layout (header, footer,
   dashboard sidebars) and the main public-facing pages in full. Extra
   page-specific copy can be added the same way: add the string in both
   languages here, then add data-i18n="your.key" to the element in HTML.
   ========================================================================== */

const TRANSLATIONS = {

  ar: {
    /* -------------------- Shared: header / navigation -------------------- */
    "nav.home": "الرئيسية",
    "nav.specialists": "ابحث عن معالج",
    "nav.articles": "المقالات",
    "nav.about": "معلومات عنا",
    "nav.emergency": "حالات الطوارئ",
    "nav.login": "تسجيل الدخول",
    "nav.start": "ابدأ الآن",
    "nav.myAccount": "حسابي",

    /* -------------------- Shared: footer -------------------- */
    "footer.privacy": "سياسة الخصوصية",
    "footer.terms": "شروط الخدمة",
    "footer.support": "تواصل مع الدعم",
    "footer.careers": "الوظائف",
    "footer.rights": "© 2024 إطمئن. ملاذك الآمن.",

    /* -------------------- Shared: buttons / misc -------------------- */
    "btn.next": "التالي",
    "btn.previous": "السابق",
    "btn.viewResult": "عرض النتيجة",
    "btn.viewProfile": "عرض الملف الشخصي",
    "btn.bookSession": "احجز جلستك الأولى",
    "btn.howItWorks": "كيف نعمل؟",
    "btn.viewAll": "عرض جميع المعالجين",
    "btn.confirmBooking": "تأكيد الحجز",
    "btn.continueBooking": "متابعة الحجز",

    /* -------------------- Homepage -------------------- */
    "home.badge": "شريكك الموثوق في الصحة النفسية",
    "home.heroTitle": "رحلة الهدوء تبدأ",
    "home.heroTitleHighlight": "من هنا.",
    "home.heroDesc": "منصة \"إطمئن\" توفر لك مساحة آمنة وخصوصية تامة للتواصل مع نخبة من المعالجين النفسيين المختصين لمساعدتك في تخطي تحدياتك النفسية وتحقيق السلام الداخلي.",

    "home.featuresTitle": "ميزات تجعل تجربتك فريدة",
    "home.featuresDesc": "نحن نؤمن بأن الصحة النفسية يجب أن تكون متاحة، سرية، ومدعومة بأحدث التقنيات.",
    "home.privacyTitle": "خصوصية تامة",
    "home.privacyDesc": "يمكنك التحدث بهوية مجهولة تماماً. بياناتك مشفرة ولا يتم مشاركتها مع أي جهة خارجية.",
    "home.matchingTitle": "مطابقة ذكية للخبراء",
    "home.matchingDesc": "نستخدم خوارزميات متطورة لربطك بالمعالج الأنسب لحالتك بناءً على اهتماماتك واحتياجاتك الخاصة.",
    "home.progressTitle": "تتبع التقدم",
    "home.progressDesc": "راقب تطور حالتك النفسية من خلال أدوات تتبع الحالة المزاجية والتقارير الدورية التي يقدمها المعالج.",

    "home.howTitle": "كيف تبدأ رحلتك؟",
    "home.step1Title": "1. إنشاء حساب",
    "home.step1Desc": "سجّل بياناتك الأساسية واهتماماتك النفسية في أقل من دقيقتين.",
    "home.step2Title": "2. ملء الاستبيان",
    "home.step2Desc": "أجب على بعض الأسئلة لنفهم حالتك ونرشح لك المعالج المثالي.",
    "home.step3Title": "3. حجز الجلسة",
    "home.step3Desc": "اختر الموعد الذي يناسبك من بين المواعيد المتاحة.",
    "home.step4Title": "4. ابدأ التحدث",
    "home.step4Desc": "تواصل مع معالجك عبر الفيديو، الصوت أو المحادثة النصية.",

    "home.specialistsTitle": "خبراء مستعدون لمساعدتك",
    "home.specialistsDesc": "نخبة من الأطباء والمعالجين النفسيين المرخصين.",

    "home.ctaTitle": "هل أنت مستعد لتغيير حياتك؟",
    "home.ctaDesc": "انضم إلى آلاف المرضى الذين وجدوا راحتهم النفسية معنا. الجلسة الأولى دائماً بخصم 50%.",
    "home.ctaTalk": "تحدث معنا",
    "home.ctaRegister": "سجل الآن",

    /* -------------------- Login -------------------- */
    "login.welcomeBadge": "أهلاً بعودتك",
    "login.sideTitle": "مساحتك الآمنة للحديث بحرية لا تزال بانتظارك.",
    "login.sideDesc": "سجّل دخولك لمتابعة جلساتك، والتواصل مع معالجك، ومتابعة تقدمك النفسي في أي وقت.",
    "login.title": "تسجيل الدخول",
    "login.subtitle": "سعداء بعودتك. أدخل بياناتك للمتابعة.",
    "login.emailLabel": "البريد الإلكتروني الجامعي",
    "login.passwordLabel": "كلمة المرور",
    "login.remember": "تذكرني",
    "login.forgot": "نسيت كلمة المرور؟",
    "login.submit": "تسجيل الدخول",
    "login.or": "أو",
    "login.asDoctor": "حساب معالج",
    "login.asAdmin": "حساب مدير",
    "login.noAccount": "ليس لديك حساب؟",
    "login.createAccount": "أنشئ حسابًا جديدًا",

    /* -------------------- Register -------------------- */
    "register.title": "إنشاء حساب مريض",
    "register.subtitle": "املأ بياناتك، ثم أجب على استبيان قصير لنرشّح لك المعالج المناسب.",
    "register.firstName": "الاسم الأول",
    "register.lastName": "اسم العائلة",
    "register.university": "الجامعة",
    "register.confirmPassword": "تأكيد كلمة المرور",
    "register.anonTitle": "تفعيل وضع الاستخدام المجهول",
    "register.anonDesc": "استخدم اسمًا مستعارًا أثناء جلساتك",
    "register.agree": "أوافق على",
    "register.terms": "شروط الخدمة",
    "register.and": "و",
    "register.privacy": "سياسة الخصوصية",
    "register.submit": "إنشاء الحساب ومتابعة الاستبيان",
    "register.haveAccount": "لديك حساب بالفعل؟",
    "register.rolePatient": "مريض",
    "register.roleTherapist": "معالج",
    "register.specialty": "التخصص الدقيق",
    "register.expYears": "سنوات الخبرة",
    "register.bio": "نبذة تعريفية مختصرة",
    "register.certificates": "الشهادات والخبرات (يمكن إرفاق أكثر من ملف)",
    "register.uploadHint": "اضغط هنا لإرفاق شهاداتك (PDF أو صورة) أو أي مستند يثبت خبرتك",

    /* -------------------- Forgot / reset / verify -------------------- */
    "forgot.title": "نسيت كلمة المرور؟",
    "forgot.subtitle": "أدخل بريدك الإلكتروني الجامعي وسنرسل لك رمز تحقق لإعادة تعيين كلمة المرور.",
    "forgot.submit": "إرسال رمز التحقق",
    "forgot.backToLogin": "العودة إلى تسجيل الدخول",

    "reset.title": "إعادة تعيين كلمة المرور",
    "reset.subtitle": "أدخل رمز التحقق المرسل إلى بريدك، ثم كلمة مرورك الجديدة.",
    "reset.codeLabel": "رمز التحقق",
    "reset.newPassword": "كلمة المرور الجديدة",
    "reset.submit": "تحديث كلمة المرور",

    "verify.title": "تحقق من بريدك الإلكتروني",
    "verify.subtitle": "أرسلنا رمز تحقق مكوّن من 6 أرقام إلى بريدك الجامعي. أدخله بالأسفل لتفعيل حسابك.",
    "verify.submit": "تأكيد الحساب",
    "verify.resend": "لم يصلك الرمز؟ إعادة الإرسال",

    /* -------------------- Assessment -------------------- */
    "assessment.badge": "نظام المطابقة الذكي",
    "assessment.title": "لنتعرف على احتياجك",
    "assessment.subtitle": "إجاباتك سرّية تمامًا، وتُستخدم فقط لترشيح المعالج الأنسب لحالتك.",
    "assessment.skip": "تخطي الاستبيان",
    "assessment.timeHint": "يستغرق أقل من دقيقتين",
    "assessment.resultTitle": "وجدنا لك تطابقًا رائعًا!",
    "assessment.resultDesc": "بناءً على إجاباتك، رشّح لك نظام المطابقة الذكي المعالجة التالية:",
    "assessment.browseOthers": "تصفّح معالجين آخرين",

    /* -------------------- Specialists listing -------------------- */
    "specialists.title": "ابحث عن معالجك المناسب",
    "specialists.subtitle": "تصفّح نخبة من المعالجين النفسيين المرخصين، أو دع نظام المطابقة الذكي يرشّح لك الأنسب.",
    "specialists.searchPlaceholder": "ابحث بالاسم أو التخصص...",
    "specialists.autoMatch": "دعني أُرشَّح تلقائيًا",
    "specialists.filterToday": "متاح اليوم",
    "specialists.filterAnon": "يقبل الوضع المجهول",
    "specialists.filterRating": "تقييم 4.5+",

    /* -------------------- About / Articles / Emergency -------------------- */
    "about.title": "من نحن",
    "about.subtitle": "منصة إطمئن هي مبادرة رقمية لدعم الصحة النفسية للمرضى والشباب.",
    "articles.title": "المقالات",
    "articles.subtitle": "محتوى توعوي في الصحة النفسية يكتبه فريقنا من المختصين.",
    "emergency.title": "هل تمر بحالة طارئة؟",
    "emergency.subtitle": "إذا كنت تفكر بإيذاء نفسك أو غيرك، الرجاء التواصل فورًا مع أحد خطوط المساندة أدناه أو التوجه لأقرب غرفة طوارئ.",

    /* -------------------- Dashboards: sidebar (shared) -------------------- */
    "sidebar.dashboard": "لوحتي",
    "sidebar.findSpecialist": "ابحث عن معالج",
    "sidebar.mySessions": "جلساتي",
    "sidebar.myProgress": "تقدمي النفسي",
    "sidebar.privacy": "الخصوصية والوضع المجهول",
    "sidebar.settings": "الإعدادات",
    "sidebar.requests": "طلبات الاستشارة",
    "sidebar.schedule": "أوقات العمل",
    "sidebar.patients": "مرضاي",
    "sidebar.chat": "الدردشة",
    "sidebar.profile": "الملف الشخصي",
    "sidebar.users": "إدارة المستخدمين",
    "sidebar.therapistApprovals": "اعتماد المعالجين",
    "sidebar.specialties": "التخصصات",
    "sidebar.complaints": "الشكاوى والتقارير",
    "sidebar.menu": "القائمة",
    "sidebar.logout": "تسجيل الخروج"
  },

  en: {
    /* -------------------- Shared: header / navigation -------------------- */
    "nav.home": "Home",
    "nav.specialists": "Find a Therapist",
    "nav.articles": "Articles",
    "nav.about": "About Us",
    "nav.emergency": "Emergency",
    "nav.login": "Log In",
    "nav.start": "Get Started",
    "nav.myAccount": "My Account",

    /* -------------------- Shared: footer -------------------- */
    "footer.privacy": "Privacy Policy",
    "footer.terms": "Terms of Service",
    "footer.support": "Contact Support",
    "footer.careers": "Careers",
    "footer.rights": "© 2024 Etma'en. Your safe place.",

    /* -------------------- Shared: buttons / misc -------------------- */
    "btn.next": "Next",
    "btn.previous": "Previous",
    "btn.viewResult": "View Result",
    "btn.viewProfile": "View Profile",
    "btn.bookSession": "Book Your First Session",
    "btn.howItWorks": "How It Works",
    "btn.viewAll": "View All Therapists",
    "btn.confirmBooking": "Confirm Booking",
    "btn.continueBooking": "Continue Booking",

    /* -------------------- Homepage -------------------- */
    "home.badge": "Your trusted mental health partner",
    "home.heroTitle": "Your journey to calm starts",
    "home.heroTitleHighlight": "right here.",
    "home.heroDesc": "Etma'en gives you a safe, completely private space to connect with licensed therapists and work through life's challenges toward real inner peace.",

    "home.featuresTitle": "Features that make your experience unique",
    "home.featuresDesc": "We believe mental health support should be accessible, confidential, and backed by modern technology.",
    "home.privacyTitle": "Complete Privacy",
    "home.privacyDesc": "Talk under a fully anonymous identity. Your data is encrypted and never shared with any third party.",
    "home.matchingTitle": "Smart Therapist Matching",
    "home.matchingDesc": "We use advanced algorithms to connect you with the therapist best suited to your needs and interests.",
    "home.progressTitle": "Track Your Progress",
    "home.progressDesc": "Monitor your mental wellbeing with mood-tracking tools and regular reports from your therapist.",

    "home.howTitle": "How does your journey start?",
    "home.step1Title": "1. Create an account",
    "home.step1Desc": "Register your basic details and areas of concern in under two minutes.",
    "home.step2Title": "2. Complete the assessment",
    "home.step2Desc": "Answer a few questions so we can recommend your ideal therapist.",
    "home.step3Title": "3. Book a session",
    "home.step3Desc": "Pick the time slot that works best for you.",
    "home.step4Title": "4. Start talking",
    "home.step4Desc": "Connect with your therapist via video, voice or text chat.",

    "home.specialistsTitle": "Experts ready to help you",
    "home.specialistsDesc": "A curated selection of licensed doctors and therapists.",

    "home.ctaTitle": "Ready to change your life?",
    "home.ctaDesc": "Join thousands of patients who found peace of mind with us. Your first session is always 50% off.",
    "home.ctaTalk": "Talk to Us",
    "home.ctaRegister": "Sign Up Now",

    /* -------------------- Login -------------------- */
    "login.welcomeBadge": "Welcome back",
    "login.sideTitle": "Your safe space to speak freely is still waiting for you.",
    "login.sideDesc": "Log in to continue your sessions, reach your therapist, and track your progress anytime.",
    "login.title": "Log In",
    "login.subtitle": "Glad to have you back. Enter your details to continue.",
    "login.emailLabel": "University Email",
    "login.passwordLabel": "Password",
    "login.remember": "Remember me",
    "login.forgot": "Forgot your password?",
    "login.submit": "Log In",
    "login.or": "or",
    "login.asDoctor": "Therapist Account",
    "login.asAdmin": "Admin Account",
    "login.noAccount": "Don't have an account?",
    "login.createAccount": "Create a new account",

    /* -------------------- Register -------------------- */
    "register.title": "Create a Patient Account",
    "register.subtitle": "Fill in your details, then complete a short assessment so we can recommend the right therapist.",
    "register.firstName": "First Name",
    "register.lastName": "Last Name",
    "register.university": "University",
    "register.confirmPassword": "Confirm Password",
    "register.anonTitle": "Enable Anonymous Mode",
    "register.anonDesc": "Use a pseudonym during your sessions",
    "register.agree": "I agree to the",
    "register.terms": "Terms of Service",
    "register.and": "and",
    "register.privacy": "Privacy Policy",
    "register.submit": "Create Account & Continue",
    "register.haveAccount": "Already have an account?",
    "register.rolePatient": "Patient",
    "register.roleTherapist": "Therapist",
    "register.specialty": "Specialty",
    "register.expYears": "Years of Experience",
    "register.bio": "Short Bio",
    "register.certificates": "Certificates & Experience (multiple files allowed)",
    "register.uploadHint": "Click to attach your certificates (PDF or image) or any proof of experience",

    /* -------------------- Forgot / reset / verify -------------------- */
    "forgot.title": "Forgot Your Password?",
    "forgot.subtitle": "Enter your university email and we'll send you a verification code to reset your password.",
    "forgot.submit": "Send Verification Code",
    "forgot.backToLogin": "Back to Log In",

    "reset.title": "Reset Your Password",
    "reset.subtitle": "Enter the verification code sent to your email, then choose a new password.",
    "reset.codeLabel": "Verification Code",
    "reset.newPassword": "New Password",
    "reset.submit": "Update Password",

    "verify.title": "Verify Your Email",
    "verify.subtitle": "We sent a 6-digit code to your university email. Enter it below to activate your account.",
    "verify.submit": "Verify Account",
    "verify.resend": "Didn't get the code? Resend",

    /* -------------------- Assessment -------------------- */
    "assessment.badge": "Smart Matching System",
    "assessment.title": "Let's understand your needs",
    "assessment.subtitle": "Your answers are completely confidential and used only to recommend the right therapist.",
    "assessment.skip": "Skip Assessment",
    "assessment.timeHint": "Takes less than 2 minutes",
    "assessment.resultTitle": "We found a great match for you!",
    "assessment.resultDesc": "Based on your answers, our smart matching system recommends:",
    "assessment.browseOthers": "Browse Other Therapists",

    /* -------------------- Specialists listing -------------------- */
    "specialists.title": "Find Your Right Therapist",
    "specialists.subtitle": "Browse our licensed therapists, or let the smart matching system recommend the best fit.",
    "specialists.searchPlaceholder": "Search by name or specialty...",
    "specialists.autoMatch": "Match Me Automatically",
    "specialists.filterToday": "Available Today",
    "specialists.filterAnon": "Supports Anonymous Mode",
    "specialists.filterRating": "4.5+ Rating",

    /* -------------------- About / Articles / Emergency -------------------- */
    "about.title": "About Us",
    "about.subtitle": "Etma'en is a digital initiative supporting the mental health of patients and young adults.",
    "articles.title": "Articles",
    "articles.subtitle": "Mental-health awareness content written by our team of specialists.",
    "emergency.title": "Are you in crisis?",
    "emergency.subtitle": "If you are thinking about harming yourself or others, please contact one of the support lines below immediately or go to your nearest emergency room.",

    /* -------------------- Dashboards: sidebar (shared) -------------------- */
    "sidebar.dashboard": "My Dashboard",
    "sidebar.findSpecialist": "Find a Therapist",
    "sidebar.mySessions": "My Sessions",
    "sidebar.myProgress": "My Progress",
    "sidebar.privacy": "Privacy & Anonymous Mode",
    "sidebar.settings": "Settings",
    "sidebar.requests": "Consultation Requests",
    "sidebar.schedule": "Working Hours",
    "sidebar.patients": "My Patients",
    "sidebar.chat": "Chat",
    "sidebar.profile": "Profile",
    "sidebar.users": "Manage Users",
    "sidebar.therapistApprovals": "Therapist Approvals",
    "sidebar.specialties": "Specialties",
    "sidebar.complaints": "Complaints & Reports",
    "sidebar.menu": "Menu",
    "sidebar.logout": "Log Out"
  }
};
