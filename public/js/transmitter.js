document.addEventListener('DOMContentLoaded', function() {
    const budgetInput = document.getElementById('budget');
    const submitBtn = document.getElementById('submitTransmitterBtn');
    const budgetError = document.getElementById('budgetError');
    const notAllocatedBudget = document.getElementById("submitTransmitterBtn").dataset.restbudget;
    const form = document.getElementById('addTransmitterForm');

    function validateBudget() {
        const value = parseFloat(budgetInput.value);
        if (!isNaN(value) && value > notAllocatedBudget) {
            budgetError.style.display = 'block';
            submitBtn.disabled = true;
            submitBtn.style.backgroundColor = '#ccc';
            submitBtn.style.cursor = 'not-allowed';
        } else {
            budgetError.style.display = 'none';
            submitBtn.disabled = false;
            submitBtn.style.backgroundColor = '';
            submitBtn.style.cursor = '';
        }
    }

    budgetInput.addEventListener('input', validateBudget);

    // Initial state
    submitBtn.disabled = true;
    submitBtn.style.backgroundColor = '#ccc';
    submitBtn.style.cursor = 'not-allowed';

    form.addEventListener('input', function() {
        const allFilled = Array.from(form.querySelectorAll('input[required]')).every(input => input.value.trim() !== '');
        const value = parseFloat(budgetInput.value);
        if (allFilled && !isNaN(value) && value <= notAllocatedBudget) {
            submitBtn.disabled = false;
            submitBtn.style.backgroundColor = '';
            submitBtn.style.cursor = '';
        } else {
            submitBtn.disabled = true;
            submitBtn.style.backgroundColor = '#ccc';
            submitBtn.style.cursor = 'not-allowed';
        }
    });
});