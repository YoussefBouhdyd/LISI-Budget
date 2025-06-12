document.addEventListener('DOMContentLoaded', function() {
  // Date actuelle
  const today = new Date();
  document.getElementById('current-date').value = today.toLocaleDateString('fr-FR');
  
  // Éléments du DOM
  const detailsModal = document.getElementById('details-modal');
  const rejectModal = document.getElementById('reject-modal');
  const closeModals = document.querySelectorAll('.close-modal');
  const viewButtons = document.querySelectorAll('.btn-view');
  const generateButtons = document.querySelectorAll('.btn-generate');
  const modifyButtons = document.querySelectorAll('.btn-modify');
  const commentButtons = document.querySelectorAll('.btn-comment');
  const statusFilter = document.getElementById('status-filter');
  const dateFilter = document.getElementById('date-filter');
  
  // Données simulées
  const ordersData = {
    'BC-2023-045': {
      id: 'BC-2023-045',
      date: '15/06/2023',
      budgetLine: {
        code: '22033',
        name: 'Fournitures informatiques',
        dotation: 100000,
        engaged: 45000,
        balance: 55000
      },
      items: [
        { name: 'Ordinateur portable', quantity: 3, price: 3500 },
        { name: 'Écran 24"', quantity: 3, price: 800 }
      ],
      status: 'pending',
      comments: []
    },
    'BC-2023-044': {
      id: 'BC-2023-044',
      date: '14/06/2023',
      budgetLine: {
        code: '22034',
        name: 'Matériel bureau',
        dotation: 75000,
        engaged: 30000,
        balance: 45000
      },
      items: [
        { name: 'Bureau ergonomique', quantity: 2, price: 1200 },
        { name: 'Chaise de direction', quantity: 2, price: 850 }
      ],
      status: 'review',
      comments: []
    },
    'BC-2023-043': {
      id: 'BC-2023-043',
      date: '10/06/2023',
      budgetLine: {
        code: '22035',
        name: 'Maintenance',
        dotation: 50000,
        engaged: 20000,
        balance: 30000
      },
      items: [
        { name: 'Maintenance serveur', quantity: 1, price: 3200 },
        { name: 'Licence logiciel', quantity: 1, price: 2030 }
      ],
      status: 'approved',
      comments: []
    },
    'BC-2023-042': {
      id: 'BC-2023-042',
      date: '05/06/2023',
      budgetLine: {
        code: '22033',
        name: 'Fournitures informatiques',
        dotation: 100000,
        engaged: 45000,
        balance: 55000
      },
      items: [
        { name: 'Imprimante laser', quantity: 2, price: 2500 },
        { name: 'Toner', quantity: 10, price: 487 }
      ],
      status: 'rejected',
      comments: [
        {
          date: '07/06/2023',
          author: 'Responsable Achats',
          text: 'Prix trop élevé par rapport au marché. Veuillez renégocier ou trouver un autre fournisseur.'
        }
      ]
    }
  };

  // Ouvrir le modal de détails
  function openDetailsModal(orderId) {
    const order = ordersData[orderId];
    if (!order) return;

    // Calcul des totaux
    const totalHT = order.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const totalTVA = totalHT * 0.2;
    const totalTTC = totalHT + totalTVA;
    const remainingBudget = order.budgetLine.balance - totalTTC;

    // Générer le contenu HTML
    document.getElementById('modal-content').innerHTML = `
      <div class="order-header">
        <div class="header-row">
          <span class="label">N° BC:</span>
          <span class="value">${order.id}</span>
        </div>
        <div class="header-row">
          <span class="label">Date:</span>
          <span class="value">${order.date}</span>
        </div>
        <div class="header-row">
          <span class="label">Statut:</span>
          <span class="status-badge ${order.status}">
            ${order.status === 'pending' ? '<i class="fas fa-clock"></i> En attente' : 
             order.status === 'review' ? '<i class="fas fa-search-dollar"></i> En revue' : 
             order.status === 'approved' ? '<i class="fas fa-check-circle"></i> Approuvé' : 
             '<i class="fas fa-times-circle"></i> Rejeté'}
          </span>
        </div>
      </div>

      <div class="budget-info">
        <h3><i class="fas fa-coins"></i> Ligne Budgétaire</h3>
        <div class="info-grid">
          <div class="info-item">
            <span class="label">Code:</span>
            <span class="value">${order.budgetLine.code}</span>
          </div>
          <div class="info-item">
            <span class="label">Intitulé:</span>
            <span class="value">${order.budgetLine.name}</span>
          </div>
          <div class="info-item">
            <span class="label">Dotation:</span>
            <span class="value">${formatCurrency(order.budgetLine.dotation)}</span>
          </div>
          <div class="info-item">
            <span class="label">Engagé:</span>
            <span class="value">${formatCurrency(order.budgetLine.engaged)}</span>
          </div>
          <div class="info-item">
            <span class="label">Reliquat:</span>
            <span class="value">${formatCurrency(order.budgetLine.balance)}</span>
          </div>
          <div class="info-item">
            <span class="label">Reliquat après BC:</span>
            <span class="value ${remainingBudget < 0 ? 'text-danger' : 'text-success'}">
              ${formatCurrency(remainingBudget)}
            </span>
          </div>
        </div>
      </div>

      <div class="items-section">
        <h3><i class="fas fa-boxes"></i> Articles</h3>
        <table>
          <thead>
            <tr>
              <th>Désignation</th>
              <th>Quantité</th>
              <th>Prix Unitaire</th>
              <th>Total HT</th>
            </tr>
          </thead>
          <tbody>
            ${order.items.map(item => `
              <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${formatCurrency(item.price)}</td>
                <td>${formatCurrency(item.price * item.quantity)}</td>
              </tr>
            `).join('')}
          </tbody>
        </table>
      </div>

      <div class="totals-section">
        <div class="totals-grid">
          <div class="total-row">
            <span>Total HT:</span>
            <span>${formatCurrency(totalHT)}</span>
          </div>
          <div class="total-row">
            <span>TVA (20%):</span>
            <span>${formatCurrency(totalTVA)}</span>
          </div>
          <div class="total-row grand-total">
            <span>TOTAL TTC:</span>
            <span>${formatCurrency(totalTTC)}</span>
          </div>
        </div>
      </div>

      ${order.status === 'approved' ? `
      <div class="generate-section">
        <button class="btn-generate">
          <i class="fas fa-file-pdf"></i> Générer le Bon de Commande PDF
        </button>
      </div>
      ` : ''}

      ${order.status === 'rejected' && order.comments.length > 0 ? `
      <div class="comments-section">
        <h3><i class="fas fa-comments"></i> Motif de Rejet</h3>
        ${order.comments.map(comment => `
          <div class="comment">
            <div class="comment-header">
              <span class="author">${comment.author}</span>
              <span class="date">${comment.date}</span>
            </div>
            <div class="comment-text">${comment.text}</div>
          </div>
        `).join('')}
      </div>
      
      <div class="modify-actions">
        <button class="btn-modify">
          <i class="fas fa-edit"></i> Modifier ce Bon de Commande
        </button>
      </div>
      ` : ''}
    `;

    detailsModal.style.display = 'block';
  }

  // Ouvrir le modal de rejet
  function openRejectModal(orderId) {
    const order = ordersData[orderId];
    if (!order || order.status !== 'rejected') return;

    document.getElementById('reject-content').innerHTML = `
      ${order.comments.map(comment => `
        <div class="comment">
          <div class="comment-header">
            <span class="author">${comment.author}</span>
            <span class="date">${comment.date}</span>
          </div>
          <div class="comment-text">${comment.text}</div>
        </div>
      `).join('')}
      
      <div class="instructions">
        <p>Veuillez modifier votre bon de commande en tenant compte des remarques ci-dessus.</p>
      </div>
    `;

    rejectModal.style.display = 'block';
  }

  // Fermer les modals
  function closeModalsHandler() {
    detailsModal.style.display = 'none';
    rejectModal.style.display = 'none';
  }

  // Générer un PDF (simulation)
  function generateOrderPDF(orderId) {
    console.log(`Génération du PDF pour le bon ${orderId}`);
    alert(`PDF généré pour le bon ${orderId}`);
  }

  // Rediriger vers la modification (simulation)
  function modifyOrder(orderId) {
    console.log(`Redirection vers la modification du bon ${orderId}`);
    alert(`Vous allez être redirigé pour modifier le bon ${orderId}`);
  }

  // Formater les montants
  function formatCurrency(amount) {
    return new Intl.NumberFormat('fr-FR', { 
      style: 'decimal', 
      minimumFractionDigits: 2,
      maximumFractionDigits: 2 
    }).format(amount) + ' DH';
  }

  // Filtrer les commandes (simulation)
  function filterOrders() {
    const status = statusFilter.value;
    const date = dateFilter.value;
    
    console.log(`Filtrage - Statut: ${status}, Date: ${date}`);
    // Ici vous feriez normalement une requête AJAX ou filtreriez les données existantes
  }

  // Initialisation des écouteurs d'événements
  viewButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.closest('tr').querySelector('td:first-child').textContent;
      openDetailsModal(orderId);
    });
  });
  
  generateButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.closest('tr').querySelector('td:first-child').textContent;
      generateOrderPDF(orderId);
    });
  });
  
  modifyButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.closest('tr').querySelector('td:first-child').textContent;
      modifyOrder(orderId);
    });
  });
  
  commentButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.closest('tr').querySelector('td:first-child').textContent;
      openRejectModal(orderId);
    });
  });
  
  closeModals.forEach(btn => {
    btn.addEventListener('click', closeModalsHandler);
  });
  
  window.addEventListener('click', function(event) {
    if (event.target === detailsModal || event.target === rejectModal) {
      closeModalsHandler();
    }
  });

  // Gestion des filtres
  statusFilter.addEventListener('change', filterOrders);
  dateFilter.addEventListener('change', filterOrders);

  // Gestion des boutons dans les modals
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-generate')) {
      const orderId = document.querySelector('#modal-content .value:first-child').textContent;
      generateOrderPDF(orderId);
      closeModalsHandler();
    }
    
    if (e.target.classList.contains('btn-modify')) {
      const orderId = document.querySelector('#modal-content .value:first-child').textContent || 
                      document.querySelector('#reject-content').previousElementSibling.textContent.match(/BC-\d+/)[0];
      modifyOrder(orderId);
      closeModalsHandler();
    }
  });
});