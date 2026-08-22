/* ==========================================================================
   FILE:      store.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Clean Front-end Store ready for Laravel API integration.
   ========================================================================== */

const Store = (function () {
  const DB_KEY = 'etmaen_db_v1';
  const CURRENT_PATIENT_KEY = 'etmaen_current_patient';
  const CURRENT_THERAPIST_KEY = 'etmaen_current_therapist';

  function seed() {
    return {
      therapists: {},
      patients: {},
      sessions: [],
      chats: {},
      patientNotes: {},
      complaints: [],
      deletedUserIds: [],
      specialties: [],
      pendingTherapistApprovals: [],
      rejectedTherapistApprovals: [],
      platformUsers: []
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

  /* -------------------- current logged-in user -------------------- */
  function getCurrentPatientId() { return localStorage.getItem(CURRENT_PATIENT_KEY) || null; }
  function getCurrentTherapistId() { return localStorage.getItem(CURRENT_THERAPIST_KEY) || null; }
  function setCurrentTherapistId(id) { localStorage.setItem(CURRENT_THERAPIST_KEY, id); }

  /* ------------------------------ therapists ----------------------------- */
  function getTherapist(id) { return load().therapists[id] || null; }

  function saveTherapist(therapist) {
    const db = load();
    db.therapists[therapist.id] = therapist;
    persist(db);
  }

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

  function markComplaintEmailedToSupport(id) {
    const db = load();
    const c = db.complaints.find(x => x.id === id);
    if (!c) return null;
    c.supportEmailSentAt = nowStamp();
    persist(db);
    return c;
  }

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
