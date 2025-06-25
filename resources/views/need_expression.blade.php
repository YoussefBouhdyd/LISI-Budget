@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-emetteur.css') }}">
    <link rel="stylesheet" href="{{ asset('css/framework.css') }}">
@endsection

@section('title', 'Expression de Besoin - Engagement')

@section('content')
<div class="page d-flex">
    @include('partials.sidebar_emetteur')
    <div class="content flex-1">
        @include('partials.header')
        
        <div class="section-content p-15">
            <h1 class="content-title mb-20">
                Engagement
            </h1>
            <!-- Budget Line Section -->
            <section class="budget-line bg-white rad-6 p-15 mb-10">
                <h2 class="m-15-0">Ligne Budgétaire </h2>
                
                <div class="form-group mb-20">
                    <label for="budget-select" class="d-block pl-5 mb-10 fw-bold c-777">
                        Sélectionner une ligne budgétaire:
                    </label>
                    <select id="budget-select" class="p-10 rad-6 border full-w mb-10">
                        <option value="">-- Choisir une ligne --</option>
                        @foreach($approvedBudgetLines as $line)
                            <option 
                                value="{{ $line->id }}"
                                data-code="{{ $line->budgetLine->code ?? '' }}"
                                data-dotation="{{ number_format($line->proposed_amount, 2) }}"
                                data-engaged="{{ number_format($line->spend, 2) }}"
                                data-balance="{{ number_format($line->proposed_amount - $line->spend, 2) }}"
                            >
                                {{ $line->budgetLine->name}}
                            </option>
                        @endforeach
                    </select>
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
                </div>
            </section>
            {{-- <script>
                // Access the select element
                const budgetSelect = document.getElementById('budget-select');
                budgetSelect.options[budgetSelect.selectedIndex].dataset.balance;
            </script> --}}

            <!-- Need Section -->
            <section class="items-section bg-white rad-6 p-15 mb-10">
                <h2 class="m-15-0">Besoins </h2> 
                <p class="mb-10 pl-5 c-777">
                    Veuillez écrire ici votre besoin.
                </p>
                <!-- Add Item Form -->
                <div class="add-item-form p-20 bg-f9 rad-6 mb-20">
                    <div class="form-row d-flex mb-15 gap-20">
                        <div class="form-group flex-1">
                            <label for="item-name" class="d-block mb-5 fw-bold">
                                Nature du Besoin
                            </label>
                            <input type="text" id="item-name" placeholder="Nature" class="p-10 rad-6 border-ccc full-w">
                        </div>
                        <div class="form-group flex-1">
                            <label for="item-qty" class="d-block mb-5 fw-bold">
                                Quantité
                            </label>
                            <input type="number" id="item-qty" min="1" value="1" 
                                class="p-10 rad-6 border-ccc full-w">
                        </div>
                    </div>

                    <div class="form-row d-flex mb-15 gap-20">
                        <div class="form-group flex-1">
                            <label for="item-description" class="d-block mb-5 fw-bold">
                                Description
                            </label>
                            <input type="text" id="item-description" placeholder="Description" class="p-10 rad-6 border-ccc full-w">
                        </div>
                    </div>
                    
                    <div class="form-row d-flex mb-15 gap-20">
                        <div class="form-group flex-1">
                            <label for="item-price" class="d-block mb-5 fw-bold">
                                Prix Unitaire Estimé (DH)
                            </label>
                            <input type="number" id="item-price" min="0" step="0.01" 
                                placeholder="0.00" class="p-10 rad-6 border-ccc full-w">
                        </div>
                        <div class="form-group flex-1">
                            <label for="item-total" class="d-block mb-5 fw-bold">
                                Total (DH)
                            </label>
                            <input type="text" id="item-total" value="0.00" readonly class="p-10 rad-6 border-ccc full-w bg-eee">
                            <div id="add-item-error" class="red-c fs-14 mt-5 fw-bold" style="display: none;"></div>
                        </div>
                    </div>
                    
                    <div class="form-actions d-flex flex-end gap-5">
                        <button id="add-item-btn" class="btn btn-primary rad-6 bg-blue c-white p-10 pointer d-flex gap-5">
                            <i class="fas fa-plus-circle mr-5"></i> Ajouter Article
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

<script src="{{ asset('js/need_expression.js') }}"></script>
@endsection