@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-emetteur.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('title', 'Bon de Commande')

@section('content')
<div class="page d-flex">
    @include('partials.sidebar_emetteur')
    <div class="content flex-1">
        @include('partials.header')
        
        <div class="section-content p-15">
            <h1 class="content-title mb-20">
                <i class="fas fa-file-invoice c-blue"></i> Bon de Commande
            </h1>
            
            <div class="box bg-white rad-6 p-20">
                <!-- Header Info Section -->
                <div class="header-info d-flex flex-between align-c mb-30">
                    <div class="info-item">
                        <label class="d-block mb-5 fw-bold">N° BC:</label>
                        <input type="text" id="bc-number" value="BC-2023-001" readonly 
                               class="p-10 rad-6 border-ccc w-fit bg-eee">
                    </div>
                    <div class="info-item">
                        <label class="d-block mb-5 fw-bold">Date:</label>
                        <input type="text" id="date" readonly 
                               class="p-10 rad-6 border-ccc w-fit bg-eee">
                    </div>
                </div>

                <!-- Budget Line Section -->
                <section class="budget-line mb-30">
                    <h2 class="mb-20 d-flex align-c">
                        <i class="fas fa-coins c-green mr-10"></i> 
                        <span>Ligne Budgétaire</span>
                    </h2>
                    
                    <div class="form-group mb-20">
                        <label for="budget-select" class="d-block mb-10 fw-bold">
                            Sélectionner une ligne budgétaire:
                        </label>
                        <select id="budget-select" class="p-10 rad-6 border-ccc w-full">
                            <option value="">-- Choisir une ligne --</option>
                            <option value="22033">22033 - Achat fournitures informatiques</option>
                            <option value="22034">22034 - Achat matériel bureau</option>
                            <option value="22035">22035 - Frais de maintenance</option>
                        </select>
                    </div>
                    
                    <div class="budget-details">
                        <div class="table-responsive">
                            <table class="table full-w">
                                <thead>
                                    <tr class="bg-eee">
                                        <th class="p-15 txt-l fw-bold">Code</th>
                                        <th class="p-15 txt-l fw-bold">Dotation</th>
                                        <th class="p-15 txt-l fw-bold">Engagé</th>
                                        <th class="p-15 txt-l fw-bold">Reliquat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-15 fw-bold" id="budget-code">-</td>
                                        <td class="p-15" id="budget-dotation">0.00 DH</td>
                                        <td class="p-15" id="budget-engaged">0.00 DH</td>
                                        <td class="p-15" id="budget-balance">0.00 DH</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Items Section -->
                <section class="items-section mb-30">
                    <h2 class="mb-20 d-flex align-c">
                        <i class="fas fa-boxes c-orange mr-10"></i> 
                        <span>Articles</span>
                    </h2>
                    
                    <!-- Add Item Form -->
                    <div class="add-item-form p-20 bg-f9 rad-6 mb-20">
                        <div class="form-row d-flex mb-15" style="gap: 20px;">
                            <div class="form-group flex-1">
                                <label for="item-name" class="d-block mb-5 fw-bold">
                                    Désignation
                                </label>
                                <input type="text" id="item-name" placeholder="Nom de l'article" 
                                       class="p-10 rad-6 border-ccc w-full">
                            </div>
                            <div class="form-group flex-1">
                                <label for="item-qty" class="d-block mb-5 fw-bold">
                                    Quantité
                                </label>
                                <input type="number" id="item-qty" min="1" value="1" 
                                       class="p-10 rad-6 border-ccc w-full">
                            </div>
                        </div>
                        
                        <div class="form-row d-flex mb-15" style="gap: 20px;">
                            <div class="form-group flex-1">
                                <label for="item-price" class="d-block mb-5 fw-bold">
                                    Prix unitaire (DH)
                                </label>
                                <input type="number" id="item-price" min="0" step="0.01" 
                                       placeholder="0.00" class="p-10 rad-6 border-ccc w-full">
                            </div>
                            <div class="form-group flex-1">
                                <label for="item-total" class="d-block mb-5 fw-bold">
                                    Total (DH)
                                </label>
                                <input type="text" id="item-total" value="0.00" readonly 
                                       class="p-10 rad-6 border-ccc w-full bg-eee">
                            </div>
                        </div>
                        
                        <div class="form-actions d-flex flex-end" style="gap: 10px;">
                            <button id="add-item-btn" class="btn btn-primary rad-6 bg-blue c-white p-10 pointer">
                                <i class="fas fa-plus-circle mr-5"></i> Ajouter Article
                            </button>
                            <button id="cancel-edit-btn" class="btn btn-secondary rad-6 bg-gray c-white p-10 pointer" 
                                    style="display:none;">
                                <i class="fas fa-times mr-5"></i> Annuler
                            </button>
                        </div>
                    </div>
                    
                    <!-- Items List Table -->
                    <div class="items-list table-responsive">
                        <table class="table full-w">
                            <thead>
                                <tr class="bg-eee">
                                    <th class="p-15 txt-l fw-bold">Désignation</th>
                                    <th class="p-15 txt-l fw-bold">Qté</th>
                                    <th class="p-15 txt-l fw-bold">P.U. (DH)</th>
                                    <th class="p-15 txt-l fw-bold">Total (DH)</th>
                                    <th class="p-15 txt-l fw-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="items-table-body">
                                <!-- Contenu dynamique -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Totals Section -->
                    <div class="totals-section mt-30 p-20 bg-f9 rad-6">
                        <div class="totals-grid">
                            <div class="total-row d-flex flex-between mb-10">
                                <span class="fw-bold">Total HT:</span>
                                <span id="total-ht" class="fw-bold">0.00 DH</span>
                            </div>
                            <div class="total-row d-flex flex-between mb-10">
                                <span class="fw-bold">TVA (20%):</span>
                                <span id="total-tva" class="fw-bold">0.00 DH</span>
                            </div>
                            <div class="total-row grand-total d-flex flex-between p-10 bg-blue c-white rad-6">
                                <span class="fw-bold fs-18">TOTAL TTC:</span>
                                <span id="total-ttc" class="fw-bold fs-18">0.00 DH</span>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Footer Actions -->
                <footer class="footer-actions d-flex flex-end pt-20" style="gap: 15px; border-top: 1px solid #eee;">
                    <button id="save-draft-btn" class="btn btn-secondary rad-6 bg-gray c-white p-12 pointer">
                        <i class="fas fa-save mr-5"></i> Enregistrer Brouillon
                    </button>
                    <button id="submit-order-btn" class="btn btn-primary rad-6 bg-green c-white p-12 pointer">
                        <i class="fas fa-paper-plane mr-5"></i> Valider le Bon de Commande
                    </button>
                </footer>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/bon_commande.js') }}"></script>
@endsection