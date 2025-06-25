// Make sure that the user selects a budget before enabling item fields
document.addEventListener('DOMContentLoaded', function () {
    const budgetSelect = document.getElementById('budget-select');
    const itemFields = [
        document.getElementById('item-name'),
        document.getElementById('item-qty'),
        document.getElementById('item-description'),
        document.getElementById('item-price'),
        document.getElementById('item-total'),
        document.getElementById('add-item-btn')
    ];

    function setItemFieldsDisabled(disabled) {
        itemFields.forEach(field => {
            if (field) field.disabled = disabled;
        });
    }

    // Initially disable fields
    setItemFieldsDisabled(true);

    budgetSelect.addEventListener('change', function () {
        setItemFieldsDisabled(!budgetSelect.value);
    });
});

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



// Validates that the item total does not exceed the selected budget balance and updates the add button state accordingly.

function getSelectedBalance() {
    const balanceText = document.getElementById('budget-balance').textContent.replace(/,/g, '');
    return Number.parseFloat(balanceText);
}

function getBudgetDotation() {
    const dotationText = document.getElementById('budget-dotation').textContent.replace(/,/g, '');
    return Number.parseFloat(dotationText);
}

function updateBalance(finalTotal) {
    const budgetBalanceElem = document.getElementById('budget-balance');
    if (!budgetBalanceElem) return;
    const currentDotation = getBudgetDotation();
    const newBalance = currentDotation - finalTotal;
    budgetBalanceElem.textContent = newBalance.toFixed(2) + ' DH';

    // Disable all item fields if balance is 0 or less, enable otherwise
    const itemFields = [
        document.getElementById('item-name'),
        document.getElementById('item-qty'),
        document.getElementById('item-description'),
        document.getElementById('item-price'),
        document.getElementById('item-total'),
        document.getElementById('add-item-btn')
    ];
    const shouldDisable = newBalance <= 0;
    itemFields.forEach(field => {
        if (field) field.disabled = shouldDisable;
    });
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


// Function to handle the click event of the "Add Item" button

// Add item to table
document.getElementById('add-item-btn').addEventListener('click', function() {
    const name = document.getElementById('item-name').value.trim();
    const description = document.getElementById('item-description').value.trim();
    const qty = parseFloat(document.getElementById('item-qty').value);
    const price = parseFloat(document.getElementById('item-price').value);
    const total = (qty * price).toFixed(2);

    const errorDiv = document.getElementById('add-item-error');
    errorDiv.style.display = 'none';
    errorDiv.textContent = '';

    if (!name || !description || isNaN(qty) || qty < 1 || isNaN(price) || price < 0) {
        errorDiv.textContent = 'Veuillez remplir tous les champs correctement.';
        errorDiv.style.display = 'block';
        return;
    }

    const tbody = document.getElementById('items-table-body');
    const tr = document.createElement('tr');

    tr.innerHTML = `
        <td class="p-15">${name}</td>
        <td class="p-15">${description}</td>
        <td class="p-15">${price.toFixed(2)}</td>
        <td class="p-15">${qty}</td>
        <td class="p-15">${total}</td>
        <td class="p-15">
            <button type="button" class="btn btn-danger rad-6 bg-red c-white p-5 pointer btn-remove-item">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;

    tbody.appendChild(tr);

    // Clear form
    document.getElementById('item-name').value = '';
    document.getElementById('item-description').value = '';
    document.getElementById('item-qty').value = 1;
    document.getElementById('item-price').value = '';
    document.getElementById('item-total').value = '0.00';

    updateTotals();

    // Remove item event
    tr.querySelector('.btn-remove-item').addEventListener('click', function() {
        tr.remove();
        updateTotals();
    });
});

// Update totals section
function updateTotals() {
    let finalTotal = 0;
    document.querySelectorAll('#items-table-body tr').forEach(tr => {
        const totalCell = tr.children[4];
        if (totalCell) {
            finalTotal += parseFloat(totalCell.textContent) || 0;
        }
    });
    
    document.getElementById('final-total').textContent = finalTotal.toFixed(2) + ' DH';

    updateBalance(finalTotal);
};
