@extends('layouts.app')

@section('title', 'التقييم الذاتي | إطمئن')

@section('content')
<section class="section" style="padding-top: 40px;">
  <div class="container" style="max-width: 700px;">
    
    <div style="text-align: center; margin-bottom: 30px;">
      <h1 style="font-size: 28px; margin-bottom: 10px;">التقييم النفسي المبدئي</h1>
      <p style="color: var(--text-muted);">أجب عن الأسئلة التالية بصدق لنتمكن من توجيهك للمختص الأنسب لحالتك. جميع البيانات مشفرة وسرية.</p>
    </div>

    <!-- رسالة الخطأ أو النجاح -->
    <div id="alertMessage" style="display:none; padding:15px; border-radius:8px; margin-bottom:20px; font-weight:bold; text-align:center;"></div>

    <div class="question-card">
      <form id="assessmentForm">
        
        <!-- سؤال 1 -->
        <div class="field" style="margin-bottom: 25px;">
          <label style="font-size: 16px; margin-bottom: 10px; display: block;">1. خلال الأسبوعين الماضيين، كم مرة شعرت بقلة الاهتمام أو المتعة في القيام بالأشياء؟</label>
          <select class="form-control" name="q1" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border-color);">
            <option value="" disabled selected>اختر الإجابة</option>
            <option value="0">إطلاقاً (0)</option>
            <option value="1">عدة أيام (1)</option>
            <option value="2">أكثر من نصف الأيام (2)</option>
            <option value="3">كل يوم تقريباً (3)</option>
          </select>
        </div>

        <!-- سؤال 2 -->
        <div class="field" style="margin-bottom: 25px;">
          <label style="font-size: 16px; margin-bottom: 10px; display: block;">2. كم مرة شعرت بالإحباط، الاكتئاب، أو اليأس؟</label>
          <select class="form-control" name="q2" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border-color);">
            <option value="" disabled selected>اختر الإجابة</option>
            <option value="0">إطلاقاً (0)</option>
            <option value="1">عدة أيام (1)</option>
            <option value="2">أكثر من نصف الأيام (2)</option>
            <option value="3">كل يوم تقريباً (3)</option>
          </select>
        </div>

        <!-- سؤال 3 -->
        <div class="field" style="margin-bottom: 25px;">
          <label style="font-size: 16px; margin-bottom: 10px; display: block;">3. هل تواجه صعوبة في النوم أو تنام لفترات أطول من المعتاد؟</label>
          <select class="form-control" name="q3" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border-color);">
            <option value="" disabled selected>اختر الإجابة</option>
            <option value="0">إطلاقاً (0)</option>
            <option value="1">عدة أيام (1)</option>
            <option value="2">أكثر من نصف الأيام (2)</option>
            <option value="3">كل يوم تقريباً (3)</option>
          </select>
        </div>

        <!-- قسم الملاحظات -->
        <div class="field" style="margin-bottom: 25px;">
          <label style="font-size: 16px; margin-bottom: 10px; display: block;">هل تود إضافة أي ملاحظات أخرى حول مشاعرك مؤخراً؟ (اختياري)</label>
          <textarea id="notes" class="form-control" rows="4" placeholder="اكتب أي شيء تود أن يعرفه المعالج..." style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border-color);"></textarea>
        </div>

        <button type="submit" id="submitAssessment" class="btn btn-primary btn-block" style="padding: 14px; font-size: 16px;">إرسال التقييم وعرض النتيجة</button>
      </form>
    </div>

    <!-- نتيجة التقييم تظهر هنا -->
    <div id="resultCard" class="question-card" style="display: none; margin-top: 30px; text-align: center; background: #e0f2f1; border: 2px solid var(--teal-700);">
      <h3 style="color: var(--teal-700); font-size: 22px; margin-bottom: 10px;">نتيجة التقييم المبدئي</h3>
      <p id="scoreResult" style="font-size: 18px; font-weight: bold; margin-bottom: 15px;"></p>
      <p id="recommendationText" style="margin-bottom: 20px;"></p>
      <a href="{{ route('specialists.index') }}" class="btn btn-primary">تصفح المعالجين واحجز جلسة</a>
    </div>

  </div>
</section>

<script>
document.getElementById('assessmentForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitAssessment');
    const alertBox = document.getElementById('alertMessage');
    const resultCard = document.getElementById('resultCard');
    const token = localStorage.getItem('auth_token');

    // التأكد من تسجيل الدخول قبل الإرسال
    if (!token) {
        alertBox.style.display = 'block';
        alertBox.style.background = '#ffebee';
        alertBox.style.color = '#c62828';
        alertBox.innerText = 'يجب عليك تسجيل الدخول أولاً لإرسال التقييم.';
        return;
    }

    submitBtn.disabled = true;
    submitBtn.innerText = 'جاري تحليل الإجابات...';
    alertBox.style.display = 'none';
    resultCard.style.display = 'none';

    // جمع الإجابات
    const formData = new FormData(this);
    const answers = {
        q1: formData.get('q1'),
        q2: formData.get('q2'),
        q3: formData.get('q3'),
    };
    
    // حساب مجموع النقاط المبدئي في الواجهة
    const totalScore = parseInt(answers.q1) + parseInt(answers.q2) + parseInt(answers.q3);
    const notes = document.getElementById('notes').value;

    const payload = {
        answers: answers,
        score: totalScore,
        notes: notes
    };

    try {
        const response = await fetch('/api/patient/assessment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok) {
            this.style.display = 'none'; // إخفاء الفورم
            resultCard.style.display = 'block';
            
            document.getElementById('scoreResult').innerText = `النتيجة: ${totalScore} / 9`;
            
            // تحديد التوصية بناءً على الدرجة
            let rec = '';
            if (totalScore <= 3) rec = 'حالتك مستقرة. نوصي بممارسة تقنيات الاسترخاء ومتابعة حالتك.';
            else if (totalScore <= 6) rec = 'هناك بعض المؤشرات للتوتر أو القلق المعتدل. ننصحك بحجز جلسة استشارية قريبة.';
            else rec = 'الأعراض تشير إلى ضغط نفسي مرتفع. من المهم جداً حجز جلسة مع معالج نفسي في أقرب وقت لتقديم الدعم اللازم.';
            
            document.getElementById('recommendationText').innerText = rec;
        } else {
            alertBox.style.display = 'block';
            alertBox.style.background = '#ffebee';
            alertBox.style.color = '#c62828';
            alertBox.innerText = data.message || 'حدث خطأ أثناء حفظ التقييم.';
        }
    } catch (err) {
        alertBox.style.display = 'block';
        alertBox.style.background = '#ffebee';
        alertBox.style.color = '#c62828';
        alertBox.innerText = 'خطأ في الاتصال بالسيرفر.';
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = 'إرسال التقييم وعرض النتيجة';
    }
});
</script>
@endsection