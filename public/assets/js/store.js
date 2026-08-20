/* ==========================================================================
   FILE:      store.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Front-end only "mock backend" persisted in localStorage.
              Since the project has no real server yet (see README §5), this
              file plays that role temporarily: it seeds realistic demo data
              once, then every page reads/writes through the functions below
              instead of hard-coded HTML. Swap these functions' internals for
              real `fetch()` calls to the API once the back-end exists — the
              function names/shapes are designed to map 1:1 to future
              endpoints (e.g. Store.getPendingSessions -> GET /api/sessions?status=pending).
   ========================================================================== */

const Store = (function () {
  const DB_KEY = 'etmaen_db_v1';
  const CURRENT_PATIENT_KEY = 'etmaen_current_patient';
  const CURRENT_THERAPIST_KEY = 'etmaen_current_therapist';

  function seed() {
    return {
      therapists: {
        'th-mariam': {
          id: 'th-mariam',
          name: 'د. روان الأسي',
          initials: 'ر.أ',
          email: 'rawan.alasi@example.com',
          specialty: 'علاج سلوكي معرفي (CBT)',
          bio: 'أعمل مع المرضى على تطوير أدوات عملية للتعامل مع القلق والتوتر الدراسي باستخدام أساليب العلاج السلوكي المعرفي.',
          tags: 'القلق, التوتر الدراسي, اضطرابات النوم الخفيفة, الثقة بالنفس',
          experienceYears: 6,
          sessionModes: ['text', 'audio', 'video'],
          status: 'verified',
          certificates: [
            { id: 'cert-1', name: 'شهادة الترخيص المهني — نقابة الأطباء', fileName: 'license-2026.pdf', uploadedAt: '2026-07-01', verified: true }
          ]
        },
        'th-khaled': {
          id: 'th-khaled',
          name: 'د. خميس الأسي',
          initials: 'خ.أ',
          email: 'khamis.alasi@example.com',
          specialty: 'علاج نفسي عام',
          bio: '',
          tags: '',
          experienceYears: 4,
          sessionModes: ['text'],
          status: 'verified',
          certificates: []
        }
      },
      patients: {
        'p-sara':  { id: 'p-sara',  name: 'خليل أبو رمضان',        initials: 'خ.ر', anonymous: false },
        'p-a214':  { id: 'p-a214',  name: 'مريض مجهول #A214',        initials: 'ط',   anonymous: true },
        'p-b091':  { id: 'p-b091',  name: 'مريضة مجهولة #B091',      initials: 'ط',   anonymous: true },
        'p-c558':  { id: 'p-c558',  name: 'مريض مجهول #C558',        initials: 'ط',   anonymous: true },
        'p-omar':  { id: 'p-omar',  name: 'علاء غزال',               initials: 'ع.غ', anonymous: false },
        'p-d732':  { id: 'p-d732',  name: 'مريضة مجهولة #D732',      initials: 'ط',   anonymous: true },
        'p-lina':  { id: 'p-lina',  name: 'محمد مشتهي',              initials: 'م.م', anonymous: false },
        'p-e204':  { id: 'p-e204',  name: 'مريض مجهول #E204',        initials: 'ط',   anonymous: true }
      },
      // status: pending | accepted | rejected
      sessions: [
        { id: 's-c558', patientId: 'p-c558', therapistId: 'th-mariam', topic: 'القلق والتوتر الدراسي',   matchPct: 92, requestedLabel: 'منذ شهر تقريبًا', status: 'pending' },
        { id: 's-omar', patientId: 'p-omar', therapistId: 'th-mariam', topic: 'الاحتراق الأكاديمي',      matchPct: 88, requestedLabel: 'منذ أسبوعين',     status: 'pending' },
        { id: 's-d732', patientId: 'p-d732', therapistId: 'th-mariam', topic: 'اضطرابات النوم الخفيفة',   matchPct: 84, requestedLabel: 'منذ 3 أيام',      status: 'pending' },
        { id: 's-lina', patientId: 'p-lina', therapistId: 'th-mariam', topic: 'الثقة بالنفس',            matchPct: 90, requestedLabel: 'منذ يومين',        status: 'pending' },
        { id: 's-e204', patientId: 'p-e204', therapistId: 'th-mariam', topic: 'القلق والتوتر الدراسي',   matchPct: 95, requestedLabel: 'منذ يوم',          status: 'pending' },

        { id: 's-sara-1', patientId: 'p-sara', therapistId: 'th-mariam', topic: 'القلق والتوتر الدراسي', status: 'accepted',
          mode: 'محادثة نصية', dateLabel: 'الأربعاء 9 يوليو 2025 — 12:00 ظهرًا', sessionsCount: 6 },
        { id: 's-a214-1', patientId: 'p-a214', therapistId: 'th-mariam', topic: 'الاحتراق الأكاديمي', status: 'accepted',
          mode: 'محادثة نصية', dateLabel: null, sessionsCount: 3 },
        { id: 's-b091-1', patientId: 'p-b091', therapistId: 'th-mariam', topic: 'اضطرابات النوم الخفيفة', status: 'accepted',
          mode: 'محادثة نصية', dateLabel: null, sessionsCount: 1 }
      ],
      // keyed by sessionId — created automatically the moment a session is accepted
      chats: {
        's-sara-1': [
          { sender: 'therapist', text: 'أهلًا سارة، سعيدة بانضمامك. كيف تشعرين اليوم؟', time: '10:02' },
          { sender: 'patient',   text: 'أهلًا دكتورة، بخير الحمدلله، متحمسة لأول جلسة.', time: '10:05' }
        ],
        's-a214-1': [],
        's-b091-1': []
      },
      patientNotes: {
        'p-sara': [
          { date: '9 يوليو 2025', text: 'تحسّن ملحوظ في التعامل مع أفكار القلق قبل الامتحانات. الاستمرار في تمارين التنفس اليومية ومتابعة سجل الأفكار الأسبوعي.', plan: 'علاج سلوكي معرفي — مرحلة إعادة الهيكلة المعرفية' }
        ]
      },
      complaints: [
        { id: 'c1', title: 'تأخر المعالج عن الموعد',
          complainantName: 'مريض مجهول #A214', complainantType: 'patient', complainantId: 'p-a214',
          accusedName: 'د. خميس الأسي', accusedType: 'therapist', accusedId: 'th-khaled',
          dateLabel: 'منذ يوم', status: 'open',
          description: 'تأخر المعالج عن موعد الجلسة المحدد لأكثر من 20 دقيقة دون أي إشعار مسبق، مما تسبب بإهدار وقت المريض المحجوز مسبقًا.' },
        { id: 'c2', title: 'مشكلة تقنية في الدفع',
          complainantName: 'خليل أبو رمضان', complainantType: 'patient', complainantId: 'p-sara',
          accusedName: '—', accusedType: 'system', accusedId: null,
          dateLabel: 'منذ 3 أيام', status: 'resolved',
          description: 'واجهت المريضة رسالة خطأ أثناء محاولة إتمام الدفع لجلسة غير مجانية، وتم التواصل معها لتأكيد أن المبلغ لم يُخصم فعليًا.' },
        { id: 'c3', title: 'تصعيد حالة حرجة تلقائيًا',
          complainantName: 'النظام الذكي', complainantType: 'system', complainantId: null,
          accusedName: '—', accusedType: 'system', accusedId: null,
          dateLabel: '—', status: 'in_progress',
          description: 'رصد نظام تحليل المحادثات النصية مؤشرات خطر حقيقي (ذكر إيذاء النفس) أثناء جلسة نصية جارية، فتم إنشاء هذه الحالة تلقائيًا بأولوية قصوى وتحويلها لعيادة الجامعة.' },
        { id: 'c4', title: 'سلوك غير لائق من مريض تجاه المعالج',
          complainantName: 'د. روان الأسي', complainantType: 'therapist', complainantId: 'th-mariam',
          accusedName: 'مريض مجهول #E204', accusedType: 'patient', accusedId: 'p-e204',
          dateLabel: 'منذ أسبوع', status: 'resolved',
          description: 'أبلغت المعالجة عن رسائل غير لائقة أُرسلت خلال محادثة نصية من المريض، وتم إغلاق الجلسة فورًا واتخاذ إجراء تحذيري.' }
      ],
      deletedUserIds: [],
      specialties: [
        { id: 'sp1', name: 'القلق والتوتر الدراسي', therapistsCount: 18, casesCount: 412, active: true },
        { id: 'sp2', name: 'الاكتئاب', therapistsCount: 12, casesCount: 203, active: true },
        { id: 'sp3', name: 'العلاقات الأسرية', therapistsCount: 9, casesCount: 150, active: true },
        { id: 'sp4', name: 'اضطرابات النوم', therapistsCount: 7, casesCount: 96, active: true },
        { id: 'sp5', name: 'الاحتراق الأكاديمي', therapistsCount: 6, casesCount: 74, active: true },
        { id: 'sp6', name: 'إدمان الأجهزة الذكية', therapistsCount: 0, casesCount: 0, active: false }
      ],
      // Therapist applications awaiting admin review. These carry the *full*
      // registration payload (same shape produced by Store.registerTherapist)
      // so admin/therapist-profile.html can render real data, not placeholders.
      pendingTherapistApprovals: [
        { id: 'app1', name: 'د. أحمد صقر', email: 'ahmad.saqer@example.com', phone: '079-000-1122',
          specialty: 'إرشاد أسري', qualifications: 'ماجستير إرشاد نفسي أسري — الجامعة الأردنية',
          workplace: 'عيادة الأمل النفسية، عمّان', experienceYears: 5,
          bio: 'متخصصة في الإرشاد الأسري والزوجي مع خبرة في العمل مع طلبة الجامعات.',
          tags: 'العلاقات الأسرية, الإرشاد الزوجي',
          submittedLabel: '7 يوليو 2026', submittedAt: '2026-07-07',
          certificates: [{ id: 'cert-app1-1', name: 'شهادة ماجستير إرشاد نفسي', fileName: 'masters-degree.pdf', uploadedAt: '2026-07-07', verified: false }],
          status: 'pending' },
        { id: 'app2', name: 'د. خالد الجرجاوي', email: 'khaled.jarjawi@example.com', phone: '077-222-3344',
          specialty: 'طب نفسي عام', qualifications: 'بكالوريوس طب — تخصص فرعي طب نفسي',
          workplace: 'مستشفى الجامعة', experienceYears: 3,
          bio: '', tags: '',
          submittedLabel: '5 يوليو 2026', submittedAt: '2026-07-05',
          certificates: [], status: 'pending' }
      ],
      // Full applications that were rejected — keeps the original data plus
      // the reason so the admin (and the notification email) can reference it.
      rejectedTherapistApprovals: [
        { id: 'rej1', name: 'د. يوسف حمدان', email: 'yousef.hamdan@example.com', phone: '078-555-6677',
          specialty: 'علاج نفسي عام', reason: 'الشهادات المرفقة منتهية الصلاحية ولا تُثبت ترخيصًا ساري المفعول لمزاولة المهنة. يرجى إعادة التقديم بوثائق محدّثة.',
          rejectedAt: '2026-06-20' }
      ],
      // Patients as managed from the admin panel. Real accounts created via
      // pages/register.html (patient role) are pushed in here through
      // Store.registerPatient — nothing below is invented beyond the demo
      // seed accounts that ship with the project.
      platformUsers: [
        { id: 'p-sara', name: 'خليل أبو رمضان', email: 'khalil.aburamadan@example.com', phone: '', university: 'الجامعة الأردنية',
          sessionsCount: 6, anonymousMode: true, registeredAt: '2026-04-02', status: 'accepted', statusReason: null, statusAt: '2026-04-03' },
        { id: 'p-c558', name: 'مريض مجهول #C558', email: 'c558@example.com', phone: '', university: 'جامعة النجاح الوطنية',
          sessionsCount: 2, anonymousMode: true, registeredAt: '2026-05-11', status: 'accepted', statusReason: null, statusAt: '2026-05-12' },
        { id: 'p-omar', name: 'علاء غزال', email: 'alaa.ghazal@example.com', phone: '', university: 'جامعة بيرزيت',
          sessionsCount: 1, anonymousMode: false, registeredAt: '2026-08-09', status: 'pending', statusReason: null, statusAt: null },
        { id: 'p-lina', name: 'محمد مشتهي', email: 'mohammad.moshtaha@example.com', phone: '', university: 'الجامعة الأردنية',
          sessionsCount: 4, anonymousMode: true, registeredAt: '2026-03-18',
          status: 'rejected', statusReason: 'لم يتم استكمال بيانات التسجيل الجامعية المطلوبة للتحقق من صفة المريض المنتسب للجامعة.', statusAt: '2026-03-19' },
        { id: 'p-bashar', name: 'بشار مشتهي', email: 'bashar.moshtaha@example.com', phone: '', university: 'جامعة النجاح الوطنية',
          sessionsCount: 0, anonymousMode: false, registeredAt: '2026-08-05', status: 'pending', statusReason: null, statusAt: null },
        { id: 'p-mohammad-saqer', name: 'محمد صقر', email: 'mohammad.saqer@example.com', phone: '', university: 'الجامعة الأردنية',
          sessionsCount: 3, anonymousMode: false, registeredAt: '2026-02-10', status: 'accepted', statusReason: null, statusAt: '2026-02-11' }
      ]
    };
  }

  function load() {
    let raw;
    try { raw = localStorage.getItem(DB_KEY); } catch (e) { raw = null; }
    if (!raw) {
      const db = seed();
      persist(db);
      return db;
    }
    try { return JSON.parse(raw); } catch (e) { const db = seed(); persist(db); return db; }
  }

  function persist(db) {
    try { localStorage.setItem(DB_KEY, JSON.stringify(db)); } catch (e) { /* ignore quota errors */ }
  }

  function uid(prefix) { return prefix + '-' + Math.random().toString(36).slice(2, 9); }
  function todayISO() { return new Date().toISOString().slice(0, 10); }
  function nowStamp() {
    return new Date().toLocaleString('ar-EG-u-nu-latn', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
  }

  /* -------------------- current logged-in demo user -------------------- */
  function getCurrentPatientId() { return localStorage.getItem(CURRENT_PATIENT_KEY) || 'p-sara'; }
  function getCurrentTherapistId() { return localStorage.getItem(CURRENT_THERAPIST_KEY) || 'th-mariam'; }
  function setCurrentTherapistId(id) { localStorage.setItem(CURRENT_THERAPIST_KEY, id); }

  /* ------------------------------ therapists ----------------------------- */
  function getTherapist(id) { return load().therapists[id] || null; }

  function saveTherapist(therapist) {
    const db = load();
    db.therapists[therapist.id] = therapist;
    persist(db);
  }

  /**
   * Registers a new therapist account with certificates/experience gathered
   * on the register.html form, and makes them the "logged in" therapist so
   * the doctor dashboard reflects what was just submitted. Status starts as
   * "pending" until an admin verifies the certificates (see admin/therapists.html).
   */
  function registerTherapist({ name, email, phone, specialty, qualifications, workplace, experienceYears, bio, certificateFiles }) {
    const db = load();
    const id = uid('th');
    const initials = (name || '').trim().split(/\s+/).slice(-2).map(w => w[0]).join('') || 'م.ع';
    const certificates = (certificateFiles || []).map((f, i) => ({
      id: 'cert-' + id + '-' + i,
      name: f.name,
      fileName: f.name,
      uploadedAt: todayISO(),
      verified: false
    }));
    db.therapists[id] = {
      id, name, initials, email: email || '', phone: phone || '',
      specialty: specialty || '', qualifications: qualifications || '', workplace: workplace || '',
      bio: bio || '', tags: '',
      experienceYears: experienceYears || 0,
      sessionModes: ['text'],
      status: 'pending',
      submittedAt: todayISO(),
      statusReason: null, statusAt: null,
      certificates
    };
    persist(db);
    setCurrentTherapistId(id);
    return db.therapists[id];
  }

  /* ------------------------------- patients ------------------------------ */
  function getPatient(id) { return load().patients[id] || null; }

  /**
   * Registers a new patient account from pages/register.html. Creates both
   * the lightweight `patients` record (used by sessions/chat) and the full
   * `platformUsers` record (used by admin/users.html + patient-profile.html),
   * starting in "pending" status until an admin reviews it.
   */
  function registerPatient({ name, email, phone, university, anonymousMode }) {
    const db = load();
    const id = uid('p');
    const initials = (name || '').trim().split(/\s+/).slice(0, 2).map(w => w[0]).join('.') || 'م';
    db.patients[id] = { id, name, initials, anonymous: !!anonymousMode };
    const record = {
      id, name, email: email || '', phone: phone || '', university: university || '',
      sessionsCount: 0, anonymousMode: !!anonymousMode,
      registeredAt: todayISO(), status: 'pending', statusReason: null, statusAt: null
    };
    db.platformUsers.push(record);
    persist(db);
    return record;
  }

  /* ------------------------------- sessions ------------------------------- */
  function getPendingSessions(therapistId) {
    const db = load();
    return db.sessions
      .filter(s => s.therapistId === therapistId && s.status === 'pending')
      .map(s => ({ ...s, patient: db.patients[s.patientId] }));
  }

  function getAcceptedSessionsForTherapist(therapistId) {
    const db = load();
    return db.sessions
      .filter(s => s.therapistId === therapistId && s.status === 'accepted')
      .map(s => ({ ...s, patient: db.patients[s.patientId] }));
  }

  function getSessionsForPatient(patientId) {
    const db = load();
    return db.sessions
      .filter(s => s.patientId === patientId)
      .map(s => ({ ...s, therapist: db.therapists[s.therapistId] }));
  }

  function getSession(sessionId) {
    const db = load();
    return db.sessions.find(s => s.id === sessionId) || null;
  }

  /**
   * Patient books a session from booking.html — creates a *pending* request
   * that will show up for the therapist on doctor/requests.html.
   */
  function createSessionRequest({ patientId, therapistId, topic, mode }) {
    const db = load();
    const session = {
      id: uid('s'), patientId, therapistId, topic: topic || 'استشارة عامة',
      matchPct: null, requestedLabel: 'الآن', status: 'pending', mode: mode || 'محادثة نصية'
    };
    db.sessions.push(session);
    persist(db);
    return session;
  }

  /**
   * Accepting a request: flips status to accepted AND auto-creates the chat
   * thread between the patient and therapist, exactly as requested.
   */
  function acceptSession(sessionId) {
    const db = load();
    const session = db.sessions.find(s => s.id === sessionId);
    if (!session) return null;
    session.status = 'accepted';
    session.sessionsCount = (session.sessionsCount || 0) + 1;
    if (!db.chats[sessionId]) db.chats[sessionId] = [];
    persist(db);
    return session;
  }

  function rejectSession(sessionId) {
    const db = load();
    const session = db.sessions.find(s => s.id === sessionId);
    if (!session) return null;
    session.status = 'rejected';
    persist(db);
    return session;
  }

  /* --------------------------------- chat --------------------------------- */
  function getMessages(sessionId) {
    const db = load();
    return db.chats[sessionId] || [];
  }

  function sendMessage(sessionId, sender, text) {
    const db = load();
    if (!db.chats[sessionId]) db.chats[sessionId] = [];
    const msg = { sender, text, time: new Date().toLocaleTimeString('ar', { hour: '2-digit', minute: '2-digit' }) };
    db.chats[sessionId].push(msg);
    persist(db);
    return msg;
  }

  /* ----------------------------- patient notes ----------------------------- */
  function getPatientNotes(patientId) {
    const db = load();
    return db.patientNotes[patientId] || [];
  }

  function savePatientNote(patientId, note) {
    const db = load();
    if (!db.patientNotes[patientId]) db.patientNotes[patientId] = [];
    db.patientNotes[patientId].unshift({
      date: new Date().toLocaleDateString('ar-EG-u-nu-latn', { day: 'numeric', month: 'long', year: 'numeric' }),
      text: note.text, plan: note.plan
    });
    persist(db);
  }

  /* ------------------------------- complaints ------------------------------- */
  function getComplaints() { return load().complaints; }
  function getComplaint(id) { return load().complaints.find(c => c.id === id) || null; }

  /**
   * Marks a complaint resolved and records *who* resolved it and *when*,
   * persisted so it survives a page reload (per admin dashboard spec §8).
   */
  function resolveComplaint(id, status, adminName) {
    const db = load();
    const c = db.complaints.find(x => x.id === id);
    if (!c) return null;
    c.status = status;
    if (status === 'resolved') {
      c.resolvedAt = nowStamp();
      c.resolvedBy = adminName || 'مدير المنصة';
    }
    persist(db);
    return c;
  }

  /**
   * Records that the complaint was emailed to technical support (button
   * turns green + stays green after reload — see admin/complaint-details.html).
   * Only ever called after the email client actually opened successfully.
   */
  function markComplaintEmailedToSupport(id) {
    const db = load();
    const c = db.complaints.find(x => x.id === id);
    if (!c) return null;
    c.supportEmailSentAt = nowStamp();
    persist(db);
    return c;
  }

  /**
   * Admin action: deletes a user account (patient or therapist) referenced
   * by a complaint. Cascades: cancels their sessions/chats too, and updates
   * the matching platformUsers / therapists record so the change is visible
   * consistently across the whole admin panel (not just this complaint).
   */
  function deleteUser(type, id, reason) {
    if (!id) return false;
    const db = load();
    if (type === 'therapist') {
      delete db.therapists[id];
    } else if (type === 'patient') {
      delete db.patients[id];
      const pu = db.platformUsers.find((u) => u.id === id);
      if (pu) { pu.status = 'deleted'; pu.statusReason = reason || null; pu.statusAt = nowStamp(); }
    }
    db.sessions.forEach(s => {
      if (s.patientId === id || s.therapistId === id) s.status = 'rejected';
    });
    if (!db.deletedUserIds.includes(id)) db.deletedUserIds.push(id);
    persist(db);
    return true;
  }

  /* ------------------------------- specialties ------------------------------- */
  function getSpecialties() { return load().specialties; }

  function addSpecialty(name) {
    const db = load();
    const sp = { id: uid('sp'), name, therapistsCount: 0, casesCount: 0, active: false };
    db.specialties.push(sp);
    persist(db);
    return sp;
  }

  function updateSpecialtyName(id, name) {
    const db = load();
    const sp = db.specialties.find((s) => s.id === id);
    if (!sp) return null;
    sp.name = name;
    persist(db);
    return sp;
  }

  function toggleSpecialtyActive(id) {
    const db = load();
    const sp = db.specialties.find((s) => s.id === id);
    if (!sp) return null;
    sp.active = !sp.active;
    persist(db);
    return sp;
  }

  function deleteSpecialty(id) {
    const db = load();
    const idx = db.specialties.findIndex((s) => s.id === id);
    if (idx === -1) return false;
    db.specialties.splice(idx, 1);
    persist(db);
    return true;
  }

  /* ------------------------- therapist approvals (admin) ------------------------- */
  // A therapist can be found in one of three buckets while a review is in
  // progress: db.pendingTherapistApprovals (either the demo seed apps, OR —
  // more importantly — anyone who registered for real through register.html
  // and is sitting in db.therapists with status:'pending'). We merge both so
  // nothing real gets silently hidden from the admin.
  function getPendingTherapists() {
    const db = load();
    const mock = db.pendingTherapistApprovals.map((a) => ({ ...a, source: 'mock' }));
    const real = Object.values(db.therapists)
      .filter((t) => t.status === 'pending')
      .map((t) => ({ ...t, submittedLabel: t.submittedAt || '—', source: 'real' }));
    return [...real, ...mock];
  }

  function getApprovedTherapists() {
    const db = load();
    return Object.values(db.therapists).filter((t) => t.status === 'verified' || t.status === undefined);
  }

  function getFrozenTherapists() {
    const db = load();
    return Object.values(db.therapists).filter((t) => t.status === 'frozen');
  }

  function getRejectedTherapists() { return load().rejectedTherapistApprovals; }

  function getTherapistApplication(id, source) {
    const db = load();
    if (source === 'real') return db.therapists[id] || null;
    return db.pendingTherapistApprovals.find((a) => a.id === id) || null;
  }

  /**
   * Approves a therapist application, whichever bucket it's in, and message:
   * "تم قبول المعالج بعد التحقق من البيانات والشهادات."
   */
  function approveTherapist(id, source) {
    const db = load();
    if (source === 'real') {
      const t = db.therapists[id];
      if (!t) return null;
      t.status = 'verified';
      t.statusReason = null;
      t.statusAt = nowStamp();
      persist(db);
      return t;
    }
    const idx = db.pendingTherapistApprovals.findIndex((a) => a.id === id);
    if (idx === -1) return null;
    const [app] = db.pendingTherapistApprovals.splice(idx, 1);
    const newId = uid('th');
    db.therapists[newId] = {
      id: newId, name: app.name, initials: (app.name || '').replace('د. ', '').split(' ').map(w => w[0]).join('.'),
      email: app.email || '', phone: app.phone || '',
      specialty: app.specialty || '', qualifications: app.qualifications || '', workplace: app.workplace || '',
      bio: app.bio || '', tags: app.tags || '', experienceYears: app.experienceYears || 0,
      sessionModes: ['text'], status: 'verified', statusReason: null, statusAt: nowStamp(),
      certificates: app.certificates || []
    };
    persist(db);
    return db.therapists[newId];
  }

  /**
   * Rejects a therapist application (real or mock) and records the reason,
   * keeping the full profile data around so it can still be reviewed later
   * and so the rejection email has real details to reference.
   */
  function rejectTherapist(id, source, reason) {
    const db = load();
    const finalReason = reason || 'لم يستوفِ متطلبات الاعتماد.';
    if (source === 'real') {
      const t = db.therapists[id];
      if (!t) return null;
      db.rejectedTherapistApprovals.unshift({
        id: t.id, name: t.name, email: t.email || '', phone: t.phone || '',
        specialty: t.specialty || '', reason: finalReason, rejectedAt: nowStamp()
      });
      delete db.therapists[id];
      persist(db);
      return t;
    }
    const idx = db.pendingTherapistApprovals.findIndex((a) => a.id === id);
    if (idx === -1) return null;
    const [app] = db.pendingTherapistApprovals.splice(idx, 1);
    db.rejectedTherapistApprovals.unshift({
      id: app.id, name: app.name, email: app.email || '', phone: app.phone || '',
      specialty: app.specialty || '', reason: finalReason, rejectedAt: nowStamp()
    });
    persist(db);
    return app;
  }

  /**
   * Freezes an already-approved therapist's account (e.g. following a
   * patient complaint). Requires a reason, which is stored and later shown
   * in the approval interface + sent to the therapist by email.
   */
  function freezeTherapist(id, reason) {
    const db = load();
    const t = db.therapists[id];
    if (!t) return null;
    t.status = 'frozen';
    t.statusReason = reason || null;
    t.statusAt = nowStamp();
    persist(db);
    return t;
  }

  /* ------------------------------ platform users (admin) ------------------------------ */
  function getPlatformUsers() { return load().platformUsers; }
  function getPlatformUser(id) { return load().platformUsers.find((u) => u.id === id) || null; }

  /** "تم قبول المستخدم لاستيفائه الشروط." */
  function acceptPlatformUser(id) {
    const db = load();
    const u = db.platformUsers.find((x) => x.id === id);
    if (!u) return null;
    u.status = 'accepted';
    u.statusReason = null;
    u.statusAt = nowStamp();
    persist(db);
    return u;
  }

  function rejectPlatformUser(id, reason) {
    const db = load();
    const u = db.platformUsers.find((x) => x.id === id);
    if (!u) return null;
    u.status = 'rejected';
    u.statusReason = reason || 'لم يتم استكمال الشروط المطلوبة.';
    u.statusAt = nowStamp();
    persist(db);
    return u;
  }

  function deletePlatformUser(id, reason) {
    return deleteUser('patient', id, reason);
  }

  return {
    DB_KEY, load, persist, seed,
    getCurrentPatientId, getCurrentTherapistId, setCurrentTherapistId,
    getTherapist, saveTherapist, registerTherapist,
    getPatient, registerPatient,
    getPendingSessions, getAcceptedSessionsForTherapist, getSessionsForPatient, getSession,
    createSessionRequest, acceptSession, rejectSession,
    getMessages, sendMessage,
    getPatientNotes, savePatientNote,
    getComplaints, getComplaint, resolveComplaint, markComplaintEmailedToSupport, deleteUser,
    getSpecialties, addSpecialty, updateSpecialtyName, toggleSpecialtyActive, deleteSpecialty,
    getPendingTherapists, getApprovedTherapists, getFrozenTherapists, getRejectedTherapists,
    getTherapistApplication, approveTherapist, rejectTherapist, freezeTherapist,
    getPlatformUsers, getPlatformUser, acceptPlatformUser, rejectPlatformUser, deletePlatformUser
  };
})();
