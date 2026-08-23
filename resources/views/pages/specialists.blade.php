@extends('layouts.app')

@section('title', 'المختصون والخبراء | إطمئن')

@section('content')
<section class="section">
  <div class="container">
    <div style="text-align: center; margin-bottom: 30px;">
      <h1 style="font-size: 28px; margin-bottom: 8px;">تصفح الأخصائيين النفسيين</h1>
      <p style="color: var(--text-muted);">اختر المعالج المناسب لمعالجة استفساراتك وحجز جلسة بكل سرية.</p>
    </div>

    <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 30px; flex-wrap: wrap;" id="specialtyFilters">
      <button class="btn btn-sm btn-primary active-filter" data-id="all">الكل</button>
    </div>

    <div id="loadingSpinner" style="text-align: center; padding: 40px;">
      <p>جاري تحميل قائمة الأخصائيين...</p>
    </div>

    <div class="grid grid-3" id="specialistsGrid" style="display: none;">
    </div>

    <div id="noResults" style="display: none; text-align: center; padding: 40px; background: #fff; border-radius: 12px;">
      <p>لا يوجد أخصائيون متاحون لهذا التخصص حالياً.</p>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', async function () {
    const filtersContainer = document.getElementById('specialtyFilters');
    const specialistsGrid = document.getElementById('specialistsGrid');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const noResults = document.getElementById('noResults');

    let allSpecialists = [];

    try {
        const specResponse = await fetch('/api/specialties');
        if (specResponse.ok) {
            const specialties = await specResponse.json();
            specialties.forEach(spec => {
                const btn = document.createElement('button');
                btn.className = 'btn btn-sm';
                btn.style.border = '1px solid var(--border-color)';
                btn.style.background = '#fff';
                btn.dataset.id = spec.id;
                btn.innerText = spec.name || spec.title;
                btn.addEventListener('click', () => filterBySpecialty(spec.id, btn));
                filtersContainer.appendChild(btn);
            });
        }
    } catch (err) {
        console.error('خطأ في جلب التخصصات:', err);
    }

    try {
        const response = await fetch('/api/specialties'); // أو /api/admin/users إذا كان عاماً
        const data = await response.json();
        
        allSpecialists = Array.isArray(data) ? data : (data.data || []);
        
        renderSpecialists(allSpecialists);
    } catch (err) {
        console.error('خطأ في جلب البيانات:', err);
    } finally {
        loadingSpinner.style.display = 'none';
        specialistsGrid.style.display = 'grid';
    }

    function renderSpecialists(list) {
        specialistsGrid.innerHTML = '';
        if (!list || list.length === 0) {
            specialistsGrid.style.display = 'none';
            noResults.style.display = 'block';
            return;
        }

        noResults.style.display = 'none';
        specialistsGrid.style.display = 'grid';

        list.forEach(item => {
            const card = document.createElement('div');
            card.className = 'question-card';
            card.style.padding = '20px';
            card.style.textAlign = 'center';

            card.innerHTML = `
                <div style="width: 80px; height: 80px; border-radius: 50%; background: #e0f2f1; color: var(--teal-700); display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: bold; font-size: 22px;">
                    ${(item.name || 'م').charAt(0)}
                </div>
                <h3 style="font-size: 18px; margin-bottom: 6px;">${item.name || 'أخصائي نفسي'}</h3>
                <p style="color: var(--teal-700); font-size: 14px; margin-bottom: 12px;">${item.title || item.description || 'استشاري الدعم النفسي'}</p>
                <a href="/specialists/${item.id || 1}" class="btn btn-primary btn-block" style="font-size: 14px;">عرض الملف والحجز</a>
            `;
            specialistsGrid.appendChild(card);
        });
    }

    function filterBySpecialty(specId, element) {
        document.querySelectorAll('#specialtyFilters button').forEach(b => {
            b.style.background = '#fff';
            b.style.color = 'inherit';
        });
        element.style.background = 'var(--teal-700)';
        element.style.color = '#fff';

        if (specId === 'all') {
            renderSpecialists(allSpecialists);
        } else {
            const filtered = allSpecialists.filter(s => s.specialty_id == specId || s.id == specId);
            renderSpecialists(filtered);
        }
    }
});
</script>
@endsection