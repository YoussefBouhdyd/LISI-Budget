@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-emetteur.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil_emetteur.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('title', 'Mon Profil')

@section('content')
<div class="page d-flex">
    @include('partials.sidebar_emetteur')
    <div class="content flex-1">
        @include('partials.header')
        
        <div class="section-content p-15">
            <h1 class="content-title mb-20">
                <i class="fas fa-user-circle c-blue"></i> Mon Profil
            </h1>
            
            <div class="box bg-white rad-6 p-20">
                <div class="profile-wrapper">
                    <!-- Sidebar Navigation -->
                    <aside class="profile-sidebar mb-30">
                        <nav class="profile-nav d-flex" style="gap: 10px;">
                            <button class="nav-item active btn rad-6 p-10 pointer bg-blue c-white" data-section="profile">
                                <i class="fas fa-user-circle mr-5"></i>
                                <span>Informations Personnelles</span>
                            </button>
                            <button class="nav-item btn rad-6 p-10 pointer bg-gray c-white" data-section="security">
                                <i class="fas fa-lock mr-5"></i>
                                <span>Sécurité</span>
                            </button>
                        </nav>
                    </aside>

                    <!-- Main Content -->
                    <main class="profile-main">
                        <!-- Profile Section -->
                        <section id="profile" class="content-section active">
                            <div class="section-header d-flex flex-between align-c mb-30">
                                <h2 class="d-flex align-c">
                                    <i class="fas fa-user-circle c-green mr-10"></i> 
                                    <span>Informations Personnelles</span>
                                </h2>
                                <button class="edit-btn btn btn-primary rad-6 bg-blue c-white p-10 pointer" id="edit-profile-btn">
                                    <i class="fas fa-edit mr-5"></i> Modifier
                                </button>
                            </div>

                            <form class="profile-form mb-30">
                                <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                    <div class="form-group">
                                        <label for="lastname" class="d-block mb-5 fw-bold">Nom</label>
                                        <input type="text" id="lastname" value="Dupont" readonly 
                                               class="p-10 rad-6 border-ccc w-full bg-eee">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="d-block mb-5 fw-bold">Prénom</label>
                                        <input type="text" id="firstname" value="Jean" readonly 
                                               class="p-10 rad-6 border-ccc w-full bg-eee">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="d-block mb-5 fw-bold">Email</label>
                                        <input type="email" id="email" value="jean.dupont@entreprise.com" readonly 
                                               class="p-10 rad-6 border-ccc w-full bg-eee">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="d-block mb-5 fw-bold">Téléphone</label>
                                        <input type="tel" id="phone" value="+212 612 345 678" readonly 
                                               class="p-10 rad-6 border-ccc w-full bg-eee">
                                    </div>
                                    <div class="form-group">
                                        <label for="department" class="d-block mb-5 fw-bold">Département</label>
                                        <input type="text" id="department" value="Service Achats" readonly 
                                               class="p-10 rad-6 border-ccc w-full bg-eee">
                                    </div>
                                    <div class="form-group">
                                        <label for="position" class="d-block mb-5 fw-bold">Poste</label>
                                        <input type="text" id="position" value="Responsable des Achats" readonly 
                                               class="p-10 rad-6 border-ccc w-full bg-eee">
                                    </div>
                                </div>

                                <div class="form-actions d-flex flex-end mt-20" style="gap: 10px; display: none;" id="form-actions">
                                    <button type="button" class="btn btn-secondary rad-6 bg-gray c-white p-10 pointer" id="cancel-edit">
                                        <i class="fas fa-times mr-5"></i> Annuler
                                    </button>
                                    <button type="submit" class="btn btn-primary rad-6 bg-green c-white p-10 pointer">
                                        <i class="fas fa-save mr-5"></i> Enregistrer
                                    </button>
                                </div>
                            </form>

                            <!-- Statistics Section -->
                            <div class="stats-container">
                                <h3 class="mb-20 d-flex align-c">
                                    <i class="fas fa-chart-pie orange-c mr-10"></i> 
                                    <span>Mes Statistiques</span>
                                </h3>
                                <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                                    <div class="stat-card bg-f9 p-20 rad-6 d-flex align-c" style="gap: 15px;">
                                        <div class="stat-icon">
                                            <i class="fas fa-file-invoice c-blue fs-24"></i>
                                        </div>
                                        <div class="stat-info">
                                            <span class="stat-value d-block fw-bold fs-18">47</span>
                                            <span class="stat-label">Commandes</span>
                                        </div>
                                    </div>
                                    <div class="stat-card bg-f9 p-20 rad-6 d-flex align-c" style="gap: 15px;">
                                        <div class="stat-icon">
                                            <i class="fas fa-check-circle c-green fs-24"></i>
                                        </div>
                                        <div class="stat-info">
                                            <span class="stat-value d-block fw-bold fs-18">42</span>
                                            <span class="stat-label">Validées</span>
                                        </div>
                                    </div>
                                    <div class="stat-card bg-f9 p-20 rad-6 d-flex align-c" style="gap: 15px;">
                                        <div class="stat-icon">
                                            <i class="fas fa-clock orange-c fs-24"></i>
                                        </div>
                                        <div class="stat-info">
                                            <span class="stat-value d-block fw-bold fs-18">3</span>
                                            <span class="stat-label">En attente</span>
                                        </div>
                                    </div>
                                    <div class="stat-card bg-f9 p-20 rad-6 d-flex align-c" style="gap: 15px;">
                                        <div class="stat-icon">
                                            <i class="fas fa-times-circle c-red fs-24"></i>
                                        </div>
                                        <div class="stat-info">
                                            <span class="stat-value d-block fw-bold fs-18">2</span>
                                            <span class="stat-label">Rejetées</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Security Section -->
                        <section id="security" class="content-section">
                            <div class="section-header mb-30">
                                <h2 class="d-flex align-c">
                                    <i class="fas fa-lock c-red mr-10"></i> 
                                    <span>Sécurité du Compte</span>
                                </h2>
                            </div>

                            <div class="security-settings">
                                <div class="security-item bg-f9 p-20 rad-6 d-flex flex-between align-c">
                                    <div class="security-info d-flex align-c" style="gap: 15px;">
                                        <i class="fas fa-key c-blue fs-24"></i>
                                        <div>
                                            <h3 class="mb-5 fw-bold">Mot de passe</h3>
                                            <p class="c-gray">Dernière modification: 15/06/2023</p>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline rad-6 border-blue c-blue p-10 pointer" id="change-password-btn">
                                        <i class="fas fa-edit mr-5"></i> Modifier
                                    </button>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal" id="password-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div class="modal-content bg-white rad-6 p-20" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 500px;">
        <div class="modal-header d-flex flex-between align-c mb-20">
            <h3 class="d-flex align-c">
                <i class="fas fa-key c-blue mr-10"></i> 
                <span>Changer le mot de passe</span>
            </h3>
            <button class="close-modal btn rad-6 p-5 pointer" style="background: none; border: none; font-size: 20px;">&times;</button>
        </div>
        <div class="modal-body">
            <form id="password-form">
                <div class="form-group mb-20">
                    <label for="current-password" class="d-block mb-5 fw-bold">Mot de passe actuel</label>
                    <input type="password" id="current-password" required 
                           class="p-10 rad-6 border-ccc w-full">
                </div>
                <div class="form-group mb-20">
                    <label for="new-password" class="d-block mb-5 fw-bold">Nouveau mot de passe</label>
                    <input type="password" id="new-password" required 
                           class="p-10 rad-6 border-ccc w-full">
                    <div class="password-strength mt-10">
                        <div class="strength-meter d-flex" style="gap: 5px; height: 6px;">
                            <span class="strength-bar bg-red rad-3" style="flex: 1;"></span>
                            <span class="strength-bar bg-eee rad-3" style="flex: 1;"></span>
                            <span class="strength-bar bg-eee rad-3" style="flex: 1;"></span>
                            <span class="strength-bar bg-eee rad-3" style="flex: 1;"></span>
                        </div>
                        <span class="strength-text mt-5 d-block c-red">Faible</span>
                    </div>
                    <small class="password-hint mt-5 d-block c-gray">Minimum 8 caractères avec majuscules, minuscules et chiffres</small>
                </div>
                <div class="form-group mb-20">
                    <label for="confirm-password" class="d-block mb-5 fw-bold">Confirmer le mot de passe</label>
                    <input type="password" id="confirm-password" required 
                           class="p-10 rad-6 border-ccc w-full">
                </div>
                <div class="form-actions d-flex flex-end" style="gap: 10px;">
                    <button type="button" class="btn btn-secondary rad-6 bg-gray c-white p-10 pointer close-modal">
                        <i class="fas fa-times mr-5"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary rad-6 bg-green c-white p-10 pointer">
                        <i class="fas fa-save mr-5"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/profil_emetteur.js') }}"></script>

<script>
// JavaScript pour la navigation entre sections
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.content-section');
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetSection = this.getAttribute('data-section');
            
            // Mettre à jour les boutons de navigation
            navItems.forEach(nav => {
                nav.classList.remove('active', 'bg-blue');
                nav.classList.add('bg-gray');
            });
            this.classList.add('active', 'bg-blue');
            this.classList.remove('bg-gray');
            
            // Afficher/masquer les sections
            sections.forEach(section => {
                if (section.id === targetSection) {
                    section.classList.add('active');
                    section.style.display = 'block';
                } else {
                    section.classList.remove('active');
                    section.style.display = 'none';
                }
            });
        });
    });
    
    // Initialiser la première section
    document.querySelector('[data-section="profile"]').click();
});
</script>
@endsection