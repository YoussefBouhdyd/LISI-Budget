<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bon de Commande Moderne</title>
  <link rel="stylesheet" href="{{asset('css/bon_commande.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <header class="header">
      <h1><i class="fas fa-file-invoice"></i> Bon de Commande</h1>
      <div class="header-info">
        <div class="info-item">
          <span>N° BC:</span>
          <input type="text" id="bc-number" value="BC-2023-001" readonly>
        </div>
        <div class="info-item">
          <span>Date:</span>
          <input type="text" id="date" readonly>
        </div>
      </div>
    </header>

    <section class="budget-line">
      <h2><i class="fas fa-coins"></i> Ligne Budgétaire</h2>
      <div class="form-group">
        <label for="budget-select">Sélectionner une ligne budgétaire:</label>
        <select id="budget-select" class="modern-select">
          <option value="">-- Choisir une ligne --</option>
          <option value="22033">22033 - Achat fournitures informatiques</option>
          <option value="22034">22034 - Achat matériel bureau</option>
          <option value="22035">22035 - Frais de maintenance</option>
        </select>
      </div>

      <div class="budget-details">
        <table>
          <thead>
            <tr>
              <th>Code</th>
              <th>Dotation</th>
              <th>Engagé</th>
              <th>Reliquat</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td id="budget-code">-</td>
              <td id="budget-dotation">0.00 DH</td>
              <td id="budget-engaged">0.00 DH</td>
              <td id="budget-balance">0.00 DH</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <section class="items-section">
      <h2><i class="fas fa-boxes"></i> Articles</h2>
      
      <div class="add-item-form">
        <div class="form-row">
          <div class="form-group">
            <label for="item-name">Désignation</label>
            <input type="text" id="item-name" placeholder="Nom de l'article">
          </div>
          <div class="form-group">
            <label for="item-qty">Quantité</label>
            <input type="number" id="item-qty" min="1" value="1">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="item-price">Prix unitaire (DH)</label>
            <input type="number" id="item-price" min="0" step="0.01" placeholder="0.00">
          </div>
          <div class="form-group">
            <label for="item-total">Total (DH)</label>
            <input type="text" id="item-total" value="0.00" readonly>
          </div>
        </div>
        <div class="form-actions">
          <button id="add-item-btn" class="btn primary">
            <i class="fas fa-plus-circle"></i> Ajouter Article
          </button>
          <button id="cancel-edit-btn" class="btn secondary" style="display:none;">
            <i class="fas fa-times"></i> Annuler
          </button>
        </div>
      </div>

      <div class="items-list">
        <table>
          <thead>
            <tr>
              <th>Désignation</th>
              <th>Qté</th>
              <th>P.U. (DH)</th>
              <th>Total (DH)</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="items-table-body">
            <!-- Les articles seront ajoutés ici dynamiquement -->
          </tbody>
        </table>
      </div>

      <div class="totals-section">
        <div class="totals-grid">
          <div class="total-row">
            <span>Total HT:</span>
            <span id="total-ht">0.00 DH</span>
          </div>
          <div class="total-row">
            <span>TVA (20%):</span>
            <span id="total-tva">0.00 DH</span>
          </div>
          <div class="total-row grand-total">
            <span>TOTAL TTC:</span>
            <span id="total-ttc">0.00 DH</span>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer-actions">
      <button id="save-draft-btn" class="btn">
        <i class="fas fa-save"></i> Enregistrer Brouillon
      </button>
      <button id="submit-order-btn" class="btn success">
        <i class="fas fa-paper-plane"></i> Valider le Bon de Commande
      </button>
    </footer>
  </div>

  <script src="{{asset('js/bon_commande.js')}}"></script>
</body>
</html>