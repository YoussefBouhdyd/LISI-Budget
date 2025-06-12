<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon Profil | Gestion des Commandes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/profil_emetteur.css') }}">
</head>
<body>
  <div class="profile-wrapper">
    <!-- Sidebar Navigation -->
    <aside class="profile-sidebar">
      <div class="profile-header">
        <div class="avatar-container">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Photo de profil" class="profile-avatar">
          <button class="avatar-edit-btn">
            <i class="fas fa-camera"></i>
          </button>
        </div>
        <h1>Jean Dupont</h1>
        <p class="profile-title">Responsable des Achats</p>
        <div class="profile-badge">
          <i class="fas fa-shield-alt"></i>
          <span>Accès Niveau 3</span>
        </div>
      </div>

      <nav class="profile-nav">
        <button class="nav-item active" data-section="profile">
          <i class="fas fa-user-circle"></i>
          <span>Mon Profil</span>
        </button>
        <button class="nav-item" data-section="security">
          <i class="fas fa-lock"></i>
          <span>Sécurité</span>
        </button>
        <button class="nav-item" data-section="signature">
          <i class="fas fa-signature"></i>
          <span>Signature</span>
        </button>
        <button class="nav-item" data-section="activity">
          <i class="fas fa-chart-bar"></i>
          <span>Activité</span>
        </button>
        <button class="nav-item" data-section="settings">
          <i class="fas fa-cog"></i>
          <span>Paramètres</span>
        </button>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="profile-main">
      <!-- Profile Section -->
      <section id="profile" class="content-section active">
        <div class="section-header">
          <h2><i class="fas fa-user-circle"></i> Informations Personnelles</h2>
          <button class="edit-btn" id="edit-profile-btn">
            <i class="fas fa-edit"></i> Modifier
          </button>
        </div>

        <form class="profile-form">
          <div class="form-grid">
            <div class="form-group">
              <label for="lastname">Nom</label>
              <input type="text" id="lastname" value="Dupont" readonly>
            </div>
            <div class="form-group">
              <label for="firstname">Prénom</label>
              <input type="text" id="firstname" value="Jean" readonly>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" value="jean.dupont@entreprise.com" readonly>
            </div>
            <div class="form-group">
              <label for="phone">Téléphone</label>
              <input type="tel" id="phone" value="+212 612 345 678" readonly>
            </div>
            <div class="form-group">
              <label for="department">Département</label>
              <input type="text" id="department" value="Service Achats" readonly>
            </div>
            <div class="form-group">
              <label for="position">Poste</label>
              <input type="text" id="position" value="Responsable des Achats" readonly>
            </div>
          </div>

          <div class="form-actions">
            <button type="button" class="btn btn-secondary" id="cancel-edit">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>

        <div class="stats-container">
          <h3><i class="fas fa-chart-pie"></i> Mes Statistiques</h3>
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-file-invoice"></i>
              </div>
              <div class="stat-info">
                <span class="stat-value">47</span>
                <span class="stat-label">Commandes</span>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stat-info">
                <span class="stat-value">42</span>
                <span class="stat-label">Validées</span>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stat-info">
                <span class="stat-value">3</span>
                <span class="stat-label">En attente</span>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
              </div>
              <div class="stat-info">
                <span class="stat-value">2</span>
                <span class="stat-label">Rejetées</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Security Section -->
      <section id="security" class="content-section">
        <div class="section-header">
          <h2><i class="fas fa-lock"></i> Sécurité du Compte</h2>
        </div>

        <div class="security-settings">
          <div class="security-item">
            <div class="security-info">
              <i class="fas fa-key"></i>
              <div>
                <h3>Mot de passe</h3>
                <p>Dernière modification: 15/06/2023</p>
              </div>
            </div>
            <button class="btn btn-outline" id="change-password-btn">Modifier</button>
          </div>

          <div class="security-item">
            <div class="security-info">
              <i class="fas fa-mobile-alt"></i>
              <div>
                <h3>Authentification à deux facteurs</h3>
                <p>Non activée - Ajoutez une couche de sécurité supplémentaire</p>
              </div>
            </div>
            <button class="btn btn-outline">Activer</button>
          </div>

          <div class="security-item">
            <div class="security-info">
              <i class="fas fa-laptop"></i>
              <div>
                <h3>Appareils connectés</h3>
                <p>2 appareils actuellement connectés</p>
              </div>
            </div>
            <button class="btn btn-outline">Voir la liste</button>
          </div>
        </div>
      </section>

      <!-- Other sections would go here -->
    </main>
  </div>

  <!-- Change Password Modal -->
  <div class="modal" id="password-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3><i class="fas fa-key"></i> Changer le mot de passe</h3>
        <button class="close-modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="password-form">
          <div class="form-group">
            <label for="current-password">Mot de passe actuel</label>
            <input type="password" id="current-password" required>
          </div>
          <div class="form-group">
            <label for="new-password">Nouveau mot de passe</label>
            <input type="password" id="new-password" required>
            <div class="password-strength">
              <div class="strength-meter">
                <span class="strength-bar weak"></span>
                <span class="strength-bar"></span>
                <span class="strength-bar"></span>
                <span class="strength-bar"></span>
              </div>
              <span class="strength-text">Faible</span>
            </div>
            <small class="password-hint">Minimum 8 caractères avec majuscules, minuscules et chiffres</small>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" required>
          </div>
          <div class="form-actions">
            <button type="button" class="btn btn-secondary close-modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/profil_emetteur.js') }}"></script>
</body>
</html>