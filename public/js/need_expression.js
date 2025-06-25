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

// Automatically Calculate the total amount
document.addEventListener('DOMContentLoaded', function () {
    function updateTotal() {
        const qty = parseFloat(document.getElementById('item-qty').value) || 0;
        const price = parseFloat(document.getElementById('item-price').value) || 0;
        const total = qty * price;
        document.getElementById('item-total').value = total.toFixed(2) + ' DH';
    }
    document.getElementById('item-qty').addEventListener('input', updateTotal);
    document.getElementById('item-price').addEventListener('input', updateTotal);
});


/**
 * Validates that the item total does not exceed the selected budget balance and updates the add button state accordingly.
 */
function getSelectedBalance() {
    const budgetSelect = document.getElementById('budget-select');
    const selected = budgetSelect.options[budgetSelect.selectedIndex];
    let balance = selected ? selected.dataset.balance : "0";
    balance = parseFloat((balance || "0").replace(/[\s,]/g, ''));
    return isNaN(balance) ? 0 : balance;
}

function getItemTotal() {
    const itemTotalElem = document.getElementById('item-total');
    if (!itemTotalElem) return 0;
    let val = itemTotalElem.value.replace(/[^\d.,]/g, '').replace(',', '.');
    return parseFloat(val) || 0;
}

function updateAddButtonState() {
    const addBtn = document.getElementById('add-item-btn');
    const reliquat = getSelectedBalance();
    const itemTotal = getItemTotal();
    const errorDiv = document.getElementById('add-item-error');
    if (itemTotal > reliquat && reliquat > 0) {
        addBtn.disabled = true;
        addBtn.classList.add('disabled');
        errorDiv.textContent = "Le total de besoin dépasse le reliquat disponible (" + reliquat.toFixed(2) + " DH) !";
        errorDiv.style.display = "block";
    } else {
        addBtn.disabled = false;
        addBtn.classList.remove('disabled');
        errorDiv.textContent = "";
        errorDiv.style.display = "none";
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const budgetSelect = document.getElementById('budget-select');
    if (budgetSelect) {
        budgetSelect.addEventListener('change', updateAddButtonState);
    }
    function recalculateItemTotal() {
        const qty = parseFloat(document.getElementById('item-qty').value) || 0;
        const price = parseFloat(document.getElementById('item-price').value) || 0;
        const total = qty * price;
        document.getElementById('item-total').value = total.toFixed(2);
    }
    ['item-qty', 'item-price'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', function() {
                recalculateItemTotal();
                updateAddButtonState();
            });
        }
    });
    recalculateItemTotal();
    updateAddButtonState();
});
