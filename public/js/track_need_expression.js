document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-need-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var detailsRow = document.getElementById('engagement-details-' + id);
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = '';
            } else {
                detailsRow.style.display = 'none';
            }
        });
    });
});