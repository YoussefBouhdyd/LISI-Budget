document.addEventListener('DOMContentLoaded', function() {
  // Données des lignes budgétaires
  const budgetLines = {
    '22033': {
      code: '22033',
      name: 'Achat fournitures informatiques',
      dotation: 100000,
      engaged: 45000,
      balance: 55000
    },
    '22034': {
      code: '22034',
      name: 'Achat matériel bureau',
      dotation: 75000,
      engaged: 30000,
      balance: 45000
    },
    '22035': {
      code: '22035',
      name: 'Frais de maintenance',
      dotation: 50000,
      engaged: 20000,
      balance: 30000
    }
  };

  // Variables globales
  let currentEditItem = null;
  let items = [];

  // Initialisation de la date
  const today = new Date();
  document.getElementById('date').value = today.toLocaleDateString('fr-FR');

  // Écouteurs d'événements
  document.getElementById('budget-select').addEventListener('change', updateBudgetDetails);
  document.getElementById('item-qty').addEventListener('input', calculateItemTotal);
  document.getElementById('item-price').addEventListener('input', calculateItemTotal);
  document.getElementById('add-item-btn').addEventListener('click', addOrUpdateItem);
  document.getElementById('cancel-edit-btn').addEventListener('click', cancelEdit);
  document.getElementById('submit-order-btn').addEventListener('click', submitOrder);

  // Fonctions

  function updateBudgetDetails() {
    const select = document.getElementById('budget-select');
    const selectedValue = select.value;
    
    if (selectedValue && budgetLines[selectedValue]) {
      const line = budgetLines[selectedValue];
      document.getElementById('budget-code').textContent = line.code;
      document.getElementById('budget-dotation').textContent = formatCurrency(line.dotation);
      document.getElementById('budget-engaged').textContent = formatCurrency(line.engaged);
      document.getElementById('budget-balance').textContent = formatCurrency(line.balance);
    } else {
      document.getElementById('budget-code').textContent = '-';
      document.getElementById('budget-dotation').textContent = '0.00 DH';
      document.getElementById('budget-engaged').textContent = '0.00 DH';
      document.getElementById('budget-balance').textContent = '0.00 DH';
    }
  }

  function calculateItemTotal() {
    const qty = parseFloat(document.getElementById('item-qty').value) || 0;
    const price = parseFloat(document.getElementById('item-price').value) || 0;
    const total = qty * price;
    document.getElementById('item-total').value = formatCurrency(total);
  }

  function addOrUpdateItem() {
    const name = document.getElementById('item-name').value.trim();
    const qty = parseFloat(document.getElementById('item-qty').value);
    const price = parseFloat(document.getElementById('item-price').value);
    const total = qty * price;

    // Validation
    if (!name || isNaN(qty) || qty <= 0 || isNaN(price) || price <= 0) {
      alert('Veuillez remplir tous les champs avec des valeurs valides');
      return;
    }

    if (currentEditItem !== null) {
      // Mise à jour de l'article existant
      items[currentEditItem] = { name, qty, price, total };
      currentEditItem = null;
      document.getElementById('add-item-btn').innerHTML = '<i class="fas fa-plus-circle"></i> Ajouter Article';
      document.getElementById('cancel-edit-btn').style.display = 'none';
    } else {
      // Ajout d'un nouvel article
      items.push({ name, qty, price, total });
    }

    updateItemsTable();
    clearItemForm();
    calculateTotals();
  }

  function updateItemsTable() {
    const tbody = document.getElementById('items-table-body');
    tbody.innerHTML = '';

    items.forEach((item, index) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${item.name}</td>
        <td>${item.qty}</td>
        <td>${formatCurrency(item.price)}</td>
        <td>${formatCurrency(item.total)}</td>
        <td>
          <button class="btn-action edit-btn" data-index="${index}">
            <i class="fas fa-edit"></i> Modifier
          </button>
          <button class="btn-action delete-btn" data-index="${index}">
            <i class="fas fa-trash-alt"></i> Supprimer
          </button>
        </td>
      `;
      tbody.appendChild(row);
    });

    // Ajouter les écouteurs d'événements aux nouveaux boutons
    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', editItem);
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', deleteItem);
    });
  }

  function editItem(e) {
    const index = parseInt(e.currentTarget.getAttribute('data-index'));
    const item = items[index];
    
    document.getElementById('item-name').value = item.name;
    document.getElementById('item-qty').value = item.qty;
    document.getElementById('item-price').value = item.price;
    document.getElementById('item-total').value = formatCurrency(item.total);
    
    currentEditItem = index;
    document.getElementById('add-item-btn').innerHTML = '<i class="fas fa-save"></i> Mettre à jour';
    document.getElementById('cancel-edit-btn').style.display = 'inline-flex';
    
    // Faire défiler jusqu'au formulaire
    document.getElementById('item-name').focus();
  }

  function deleteItem(e) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
      const index = parseInt(e.currentTarget.getAttribute('data-index'));
      items.splice(index, 1);
      updateItemsTable();
      calculateTotals();
    }
  }

  function cancelEdit() {
    currentEditItem = null;
    clearItemForm();
    document.getElementById('add-item-btn').innerHTML = '<i class="fas fa-plus-circle"></i> Ajouter Article';
    document.getElementById('cancel-edit-btn').style.display = 'none';
  }

  function clearItemForm() {
    document.getElementById('item-name').value = '';
    document.getElementById('item-qty').value = '1';
    document.getElementById('item-price').value = '';
    document.getElementById('item-total').value = '0.00';
  }

  function calculateTotals() {
    const ht = items.reduce((sum, item) => sum + item.total, 0);
    const tva = ht * 0.2; // 20% de TVA
    const ttc = ht + tva;

    document.getElementById('total-ht').textContent = formatCurrency(ht);
    document.getElementById('total-tva').textContent = formatCurrency(tva);
    document.getElementById('total-ttc').textContent = formatCurrency(ttc);
  }

  function submitOrder() {
    const budgetLine = document.getElementById('budget-select').value;
    
    if (!budgetLine) {
      alert('Veuillez sélectionner une ligne budgétaire');
      return;
    }
    
    if (items.length === 0) {
      alert('Veuillez ajouter au moins un article');
      return;
    }

    const order = {
      number: document.getElementById('bc-number').value,
      date: document.getElementById('date').value,
      budgetLine: budgetLines[budgetLine],
      items: items,
      totalHT: parseFloat(document.getElementById('total-ht').textContent),
      totalTVA: parseFloat(document.getElementById('total-tva').textContent),
      totalTTC: parseFloat(document.getElementById('total-ttc').textContent)
    };

    // Ici vous pourriez envoyer les données au serveur
    console.log('Bon de commande soumis:', order);
    alert('Bon de commande soumis avec succès !');
    
    // Réinitialiser le formulaire
    document.getElementById('budget-select').value = '';
    updateBudgetDetails();
    items = [];
    updateItemsTable();
    calculateTotals();
  }

  function formatCurrency(amount) {
    return new Intl.NumberFormat('fr-FR', { 
      style: 'decimal', 
      minimumFractionDigits: 2,
      maximumFractionDigits: 2 
    }).format(amount) + ' DH';
  }
});