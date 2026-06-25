# 🍃 إطمأن | Etmaan - Mental Health Consultation Platform

**Etmaan (إطمأن)** هو منصة استشارات نفسية متكاملة مبنية باستخدام إطار العمل **Laravel**. تهدف المنصة إلى ربط المرضى بالأطباء والأخصائيين النفسيين في بيئة آمنة، مشفرة، وتضمن الخصوصية الكاملة لإجراء الجلسات الاستشارية (نصية/فيديو).

---

## 🚀 المميزات الرئيسية | Main Features

### 👤 بوابة المريض (Patient Portal)
- **البحث المتقدم:** تصفح الأطباء وتصفيتهم حسب التخصص، السعر، والتقييم.
- **نظام الحجز الذكي:** حجز المواعيد المتاحة فورياً والدفع الإلكتروني.
- **العيادة الافتراضية:** إجراء الجلسات عبر غرف فيديو وصوت آمنة ومحادثات نصية فورية.
- **أدوات الدعم:** مقياس الحالة المزاجية اليومي واختبارات تقييم ذاتي.

### 🩺 بوابة الطبيب (Therapist Portal)
- **إدارة المواعيد:** جدول مرن لتحديد ساعات وأيام العمل المتاحة.
- **السجل الطبي المشفر:** مساحة خاصة لكتابة وحفظ الملاحظات الطبية لكل مريض بشكل مشفر تماماً.
- **المحفظة المالية:** تتبع الأرباح المستحقة من الجلسات المكتملة.

### 🛡️ لوحة تحكم الإدارة (Admin Dashboard)
- **التحقق من الأطباء:** مراجعة الشهادات وتراخيص مزاولة المهنة قبل تفعيل الحسابات.
- **الرقابة والتقارير:** إحصائيات شاملة عن الحجوزات، الدخل، ونشاط المنصة.

---

## 🛠️ التقنيات المستخدمة | Tech Stack

- **Backend Framework:** Laravel (PHP)
- **Database:** MySQL
- **Real-time Chat:** Laravel Reverb / Pusher
- **Video/Audio Streaming:** Twilio Video API / Agora SDK
- **Authentication & Roles:** Spatie Laravel-Permission & Laravel Breeze
- **Security:** AES-256 Database Encryption (For medical notes)

---

## 💻 طريقة التشغيل والتركيب | Installation Guide

اتبع الخطوات التالية لتشغيل المشروع محلياً على جهازك:

1. **استنساخ المستودع (Clone the repository):**
```bash
   git clone [https://github.com/your-username/Etmaan-Mental-Health-Platform.git](https://github.com/your-username/Etmaan-Mental-Health-Platform.git)
   cd Etmaan-Mental-Health-Platform
