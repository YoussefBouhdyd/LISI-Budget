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
            .then(data => {
                // Show a simple popup message
                const msg = document.createElement('div');
                msg.textContent = 'Proposition acceptée !';
                msg.style.position = 'fixed';
                msg.style.top = '20px';
                msg.style.left = '50%';
                msg.style.transform = 'translateX(-50%)';
                msg.style.background = '#4caf50';
                msg.style.color = '#fff';
                msg.style.padding = '12px 24px';
                msg.style.borderRadius = '6px';
                msg.style.boxShadow = '0 2px 8px rgba(0,0,0,0.2)';
                msg.style.zIndex = '9999';
                document.body.appendChild(msg);
                setTimeout(() => {
                    msg.remove();
                }, 2000);
            })
            .catch(error => {
                alert('Erreur lors de l\'envoi');
            });
        });
    });
});