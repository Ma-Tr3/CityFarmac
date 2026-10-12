document.querySelectorAll('[data-form-category], [data-filter-category]').forEach(category => {
    const sub = document.querySelector('[data-form-subcategory], [data-filter-subcategory]');
    if (!sub) return;
    const update = () => {
        Array.from(sub.options).forEach(o => { o.hidden = !!o.dataset.parent && o.dataset.parent !== category.value; o.disabled = o.hidden; });
        if (sub.selectedOptions[0]?.disabled) sub.value = '';
        if (category.hasAttribute('data-filter-category')) filterRows();
    };
    category.addEventListener('change', update); update();
});
function filterRows() {
    const cat = document.querySelector('[data-filter-category]')?.value || '';
    const sub = document.querySelector('[data-filter-subcategory]')?.value || '';
    const rows = Array.from(document.querySelectorAll('[data-record]'));
    rows.forEach(row => { row.hidden = (!!cat && row.dataset.category !== cat) || (!!sub && row.dataset.subcategory !== sub); });
    const empty = document.querySelector('[data-empty-row]'); if (empty) empty.hidden = rows.some(r => !r.hidden);
}
document.querySelector('[data-filter-subcategory]')?.addEventListener('change', filterRows);
document.querySelector('[data-image-input]')?.addEventListener('change', event => {
    const file = event.target.files[0]; const preview = document.querySelector('[data-image-preview]');
    if (file && preview) { if (preview.dataset.blob) URL.revokeObjectURL(preview.dataset.blob); preview.dataset.blob = URL.createObjectURL(file); preview.src = preview.dataset.blob; }
});
