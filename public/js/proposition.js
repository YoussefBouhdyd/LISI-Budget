// accept proposition btn functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delegate click event for all accept buttons
    document.querySelectorAll('.accept-propo-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const propositionId = btn.getAttribute('data-id');

            
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

// Reject proposition button functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delegate click event for all accept buttons
    document.querySelectorAll('.reject-propo-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const propositionId = btn.getAttribute('data-id');

            
            fetch('/reject-proposition', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    id: propositionId
                })
            })
            .then(_ => {    
                window.location.reload();            
                showPopupMessage('Proposition rejetée !', true);
            })
            .catch(error => {
                alert('Erreur lors de l\'envoi');
            });
        });
    });
});

// Modify proposition button functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delegate click event for all modify buttons
    document.querySelectorAll('.modify-propo-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const propositionId = btn.getAttribute('data-id');
            const newValue = prompt("Entrez la nouvelle valeur pour la proposition :");

            if (newValue !== null) {
                
                fetch('/modify-proposition', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id: propositionId,
                        value: newValue
                    })
                })
                .then(_ => {    
                    window.location.reload();            
                    showPopupMessage('Proposition modifiée avec succès !', true);
                })
                .catch(error => {
                    alert('Erreur lors de l\'envoi');
                });
            }
        });
    });
});