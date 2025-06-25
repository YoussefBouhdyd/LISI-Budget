document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('budget-select');
    select.addEventListener('change', function() {
        const selected = select.options[select.selectedIndex];
        document.getElementById('budget-code').textContent = selected.dataset.code || '-';
        document.getElementById('budget-dotation').textContent = (selected.dataset.dotation || '0.00') + ' DH';
        document.getElementById('budget-engaged').textContent = (selected.dataset.engaged || '0.00') + ' DH';
        document.getElementById('budget-balance').textContent = (selected.dataset.balance || '0.00') + ' DH';
    });
});