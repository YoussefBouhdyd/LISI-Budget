document.querySelectorAll(".validate-btn").forEach(btn => {
    btn.addEventListener('click',_ => {
        const inputField  = btn.parentElement.previousElementSibling.previousElementSibling.firstChild
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
                        location.reload();
                    } else {
                        // Handle error case
                        console.error('Error in proposing a value:', request.responseText);
                        alert('Error. essay a plus tard');
                    }
                }
            };
    })
});