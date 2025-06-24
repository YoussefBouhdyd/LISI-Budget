document.querySelectorAll(".validate-btn").forEach(btn => {
    btn.addEventListener('click',_ => {
        const inputField  = btn.parentElement.previousElementSibling.previousElementSibling.firstElementChild
        const proposedValue =  inputField.value;
        const lineId = btn.dataset.lineId;
        const request = new XMLHttpRequest();
        request.open('POST','propose-line');
        request.setRequestHeader('Content-Type', 'application/json');
        request.setRequestHeader('X-CSRF-Token', csrfToken);
        request.send(JSON.stringify({ 
            value: proposedValue ,
            id : lineId
        }));
        request.onreadystatechange = function() {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    showPopupMessage('Valeur proposée avec succès !', true);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    // Handle error case
                    console.error('Error in proposing a value:', request.responseText);
                    alert('Error. essay a plus tard');
                }
            }
        };
    })
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.budget-line-prop').forEach(function(row) {
        const input = row.querySelector('.proposed-amount-input');
        const btn = row.querySelector('.validate-btn');
        if (!input || !btn) return;
        input.addEventListener('input', function() {
            const max = parseFloat(input.dataset.max);
            const val = parseFloat(input.value);
            if (val > max) {
                btn.disabled = true;
                input.classList.add('border-danger');
            } else {
                btn.disabled = false;
                input.classList.remove('border-danger');
            }
        });
    });
});