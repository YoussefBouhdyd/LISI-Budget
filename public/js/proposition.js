document.addEventListener('DOMContentLoaded', function() {
    // Delegate click event for all accept buttons
    document.querySelectorAll('.accept-propo-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const propositionId = btn.getAttribute('data-id');

            // Send AJAX request
            fetch('/confirm-proposition', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    id: propositionId
                })
            })
            .then(response => response.json())
            .then(_ => {    
                window.location.reload();            
                showPopupMessage('Proposition acceptée !', true);
            })
            .catch(error => {
                alert('Erreur lors de l\'envoi');
            });
        });
    });
});