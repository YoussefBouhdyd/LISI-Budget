@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Suivi de Mes Bons de Commande')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    @include('partials.sidebar_emetteur')
    <!-- End Side Bar  -->
    <div class="content flex-1">
        <!-- Start Page header  -->
        @include('partials.header')
        <!-- End Page header  -->
        
        <!-- Start Header Info -->

        <h1 class="content-title"> Mes Bons de Commande</h1>
        <div class="header-info-grid">
            <div class="info-item">
                <span class="emet">Émetteur:</span>
                <span class="value">Jean Dupont (Service Achats)</span>
            </div>
            <div class="info-item">
                <span>Date:</span>
                <input type="text" id="current-date" class="modern-input" readonly>
            </div>
        </div>
        <!-- End Header Info -->

        <!-- Start Bons de Commande Content -->
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <div class="orders-header">
                    <h2 class="m-15-0">Bons de Commande</h2>
                    
                    <!-- Filters integrated with the table header -->
                    <div class="filters-integrated">
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
                </div>
                
                <div class="orders-table">
                    <table class="full-w txt-l">
                        <thead>
                            <tr class="bg-eee">
                                <th class="p-10">N° BC</th>
                                <th class="p-10">Date</th>
                                <th class="p-10">Ligne Budgétaire</th>
                                <th class="p-10">Montant TTC</th>
                                <th class="p-10">Statut</th>
                                <th class="p-10">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemple de bon en attente -->
                            <tr class="status-pending">
                                <td class="tt-capital">BC-2023-045</td>
                                <td class="tt-capital">15/06/2023</td>
                                <td class="tt-capital">22033 - Fournitures info</td>
                                <td class="tt-capital">12,450.00 DH</td>
                                <td class="tt-capital">
                                    <span class="status-badge pending">
                                        <i class="fas fa-clock"></i> En attente
                                    </span>
                                </td>
                                <td class="tt-capital">
                                    <button class="btn-action btn-view">
                                        <i class="fas fa-eye"></i> Consulter
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Exemple de bon en revue -->
                            <tr class="status-review">
                                <td class="tt-capital">BC-2023-044</td>
                                <td class="tt-capital">14/06/2023</td>
                                <td class="tt-capital">22034 - Matériel bureau</td>
                                <td class="tt-capital">8,765.00 DH</td>
                                <td class="tt-capital">
                                    <span class="status-badge review">
                                        <i class="fas fa-search-dollar"></i> En revue
                                    </span>
                                </td>
                                <td class="tt-capital">
                                    <button class="btn-action btn-view">
                                        <i class="fas fa-eye"></i> Consulter
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Exemple de bon approuvé -->
                            <tr class="status-approved">
                                <td class="tt-capital">BC-2023-043</td>
                                <td class="tt-capital">10/06/2023</td>
                                <td class="tt-capital">22035 - Maintenance</td>
                                <td class="tt-capital">5,230.00 DH</td>
                                <td class="tt-capital">
                                    <span class="status-badge approved">
                                        <i class="fas fa-check-circle"></i> Approuvé
                                    </span>
                                </td>
                                <td class="tt-capital">
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
                                <td class="tt-capital">BC-2023-042</td>
                                <td class="tt-capital">05/06/2023</td>
                                <td class="tt-capital">22033 - Fournitures info</td>
                                <td class="tt-capital">9,870.00 DH</td>
                                <td class="tt-capital">
                                    <span class="status-badge rejected">
                                        <i class="fas fa-times-circle"></i> Rejeté
                                    </span>
                                </td>
                                <td class="tt-capital">
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
        </div>
        <!-- End Bons de Commande Content  -->
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

@endsection

@section('scripts')
<script>
// Script pour la date actuelle
document.addEventListener('DOMContentLoaded', function() {
    const currentDateInput = document.getElementById('current-date');
    const now = new Date();
    const dateString = now.toLocaleDateString('fr-FR');
    currentDateInput.value = dateString;
});

// Script pour les filtres
document.getElementById('status-filter').addEventListener('change', function() {
    const selectedStatus = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        if (selectedStatus === 'all') {
            row.style.display = '';
        } else {
            if (row.classList.contains('status-' + selectedStatus)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

// Script pour le filtre par date
document.getElementById('date-filter').addEventListener('change', function() {
    const selectedMonth = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    if (!selectedMonth) {
        rows.forEach(row => row.style.display = '');
        return;
    }
    
    const [year, month] = selectedMonth.split('-');
    
    rows.forEach(row => {
        const dateCell = row.cells[1].textContent;
        const [day, rowMonth, rowYear] = dateCell.split('/');
        
        if (rowMonth === month && rowYear === year) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Script pour les modals
document.querySelectorAll('.btn-view, .btn-comment').forEach(button => {
    button.addEventListener('click', function() {
        const modalId = this.classList.contains('btn-comment') ? 'reject-modal' : 'details-modal';
        document.getElementById(modalId).style.display = 'flex';
    });
});

document.querySelectorAll('.close-modal').forEach(closeBtn => {
    closeBtn.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
    });
});

// Fermer modal en cliquant à l'extérieur
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
});
</script>
@endsection