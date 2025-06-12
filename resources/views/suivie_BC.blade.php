<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suivi de Mes Bons de Commande</title>
  <link rel="stylesheet" href="{{asset('css/suivie_BC.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <header class="header">
      <h1><i class="fas fa-user-check"></i> Mes Bons de Commande</h1>
      <div class="header-info">
        <div class="info-item">
          <span>Émetteur:</span>
          <span class="value">Jean Dupont (Service Achats)</span>
        </div>
        <div class="info-item">
          <span>Date:</span>
          <input type="text" id="current-date" readonly>
        </div>
      </div>
    </header>

    <div class="filters">
      <div class="filter-group">
        <label for="status-filter">Statut:</label>
        <select id="status-filter" class="modern-select">
          <option value="all">Tous les statuts</option>
          <option value="pending">En attente</option>
          <option value="review">En revue</option>
          <option value="approved">Approuvés</option>
          <option value="rejected">Rejetés</option>
        </select>
      </div>
      <div class="filter-group">
        <label for="date-filter">Période:</label>
        <input type="month" id="date-filter" class="modern-select">
      </div>
    </div>

    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>N° BC</th>
            <th>Date</th>
            <th>Ligne Budgétaire</th>
            <th>Montant TTC</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemple de bon en attente -->
          <tr class="status-pending">
            <td>BC-2023-045</td>
            <td>15/06/2023</td>
            <td>22033 - Fournitures info</td>
            <td>12,450.00 DH</td>
            <td>
              <span class="status-badge pending">
                <i class="fas fa-clock"></i> En attente
              </span>
            </td>
            <td class="actions">
              <button class="btn-action btn-view">
                <i class="fas fa-eye"></i> Consulter
              </button>
            </td>
          </tr>
          
          <!-- Exemple de bon en revue -->
          <tr class="status-review">
            <td>BC-2023-044</td>
            <td>14/06/2023</td>
            <td>22034 - Matériel bureau</td>
            <td>8,765.00 DH</td>
            <td>
              <span class="status-badge review">
                <i class="fas fa-search-dollar"></i> En revue
              </span>
            </td>
            <td class="actions">
              <button class="btn-action btn-view">
                <i class="fas fa-eye"></i> Consulter
              </button>
            </td>
          </tr>
          
          <!-- Exemple de bon approuvé -->
          <tr class="status-approved">
            <td>BC-2023-043</td>
            <td>10/06/2023</td>
            <td>22035 - Maintenance</td>
            <td>5,230.00 DH</td>
            <td>
              <span class="status-badge approved">
                <i class="fas fa-check-circle"></i> Approuvé
              </span>
            </td>
            <td class="actions">
              <button class="btn-action btn-generate">
                <i class="fas fa-file-pdf"></i> Générer BC
              </button>
              <button class="btn-action btn-view">
                <i class="fas fa-eye"></i> Consulter
              </button>
            </td>
          </tr>
          
          <!-- Exemple de bon rejeté -->
          <tr class="status-rejected">
            <td>BC-2023-042</td>
            <td>05/06/2023</td>
            <td>22033 - Fournitures info</td>
            <td>9,870.00 DH</td>
            <td>
              <span class="status-badge rejected">
                <i class="fas fa-times-circle"></i> Rejeté
              </span>
            </td>
            <td class="actions">
              <button class="btn-action btn-modify">
                <i class="fas fa-edit"></i> Modifier
              </button>
              <button class="btn-action btn-comment">
                <i class="fas fa-comment"></i> Voir motif
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="table-footer">
        <div class="summary">
          <span>Total: 4 bons</span>
          <span class="pending-count">1 en attente</span>
          <span class="review-count">1 en revue</span>
          <span class="approved-count">1 approuvé</span>
          <span class="rejected-count">1 rejeté</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Détails -->
  <div id="details-modal" class="modal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2><i class="fas fa-file-invoice"></i> Détails du Bon de Commande</h2>
      <div id="modal-content"></div>
    </div>
  </div>

  <!-- Modal Motif de rejet -->
  <div id="reject-modal" class="modal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2><i class="fas fa-comment-slash"></i> Motif de Rejet</h2>
      <div id="reject-content"></div>
      <div class="modal-actions">
        <button class="btn-modify">
          <i class="fas fa-edit"></i> Modifier le BC
        </button>
      </div>
    </div>
  </div>

  <script src="{{asset('js/suivie_BC.js')}}"></script>
</body>
</html>