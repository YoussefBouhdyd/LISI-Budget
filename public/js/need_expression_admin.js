// accept need expression btn functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delegate click event for all accept buttons
    document.querySelectorAll('.accept-need-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const engagementId = btn.getAttribute('data-id');

            fetch('/approve-need-expression', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    id: engagementId
                })
            })
            .then(_ => {    
                window.location.reload();            
                showPopupMessage('Expression acceptée !', true);
            })
            .catch(error => {
                alert('Erreur lors de l\'envoi');
            });
        });
    });
});


// Reject need expression btn functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delegate click event for all reject buttons
    document.querySelectorAll('.reject-need-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const engagementId = btn.getAttribute('data-id');

            
            fetch('/reject-need-expression', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    id: engagementId
                })
            })
            .then(_ => {    
                window.location.reload();            
                showPopupMessage('Expression rejetée !', false);
            })
            .catch(error => {
                alert('Erreur lors de l\'envoi');
            });
        });
    });
});


// Toggle visibility of need expression details when "view" button is clicked
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