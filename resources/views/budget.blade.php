@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Engagements')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    @include('partials.sidebar')
    <!-- End Side Bar  -->
    <div class="content flex-1">
        <!-- Start Page header  -->
        @include('partials.header')
        <!-- End Page header  -->
        <h1 class="content-title">Budget</h1>

        <!-- Start Budget Content -->
        <div class="section-content p-15 d-flex gap-10 column-mobile">
            <div class="budget-stats bg-white p-15 rad-6">
                <div class="d-flex s-between align-c mb-10">
                    <h2 class="m-15-0">Budget Statics</h2>
                    <button type="button" class="btn-primary bg-blue rad-6 d-flex align-c gap-5 pointer" id="editBudgetBtn">
                        <i class="fa-solid fa-pen"></i> <span class="hide-mobile">Modifier</span>
                    </button>
                    <!-- Modal -->
                    <div id="editBudgetModal" class="modal-overlay" style="display:none;">
                        <div class="modal-content bg-white p-20 rad-6" style="min-width:300px; max-width:90vw;">
                            <h3 class="mb-15">Modifier le budget</h3>
                            <form id="budgetEditForm" method="POST" action="#">
                                @csrf
                                <div class="mb-10">
                                    <label for="budgetAmount" class="fw-bold">Montant du budget</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="budgetAmount" name="budgetAmount" value="{{ number_format($budget['amount'],2) }}" required>
                                </div>
                                <div class="mb-10">
                                    <label for="budgetSaison" class="fw-bold">Saison</label>
                                    <input type="text" class="form-control" id="budgetSaison" name="budgetSaison" value="{{ $budget['season'] }}" required>
                                </div>
                                <div class="d-flex gap-10 mt-15">
                                    <button type="submit" class="btn-primary bg-blue rad-6 pointer">Enregistrer</button>
                                    <button type="button" class="btn-primary bg-gray rad-6 pointer" id="closeBudgetModal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-c mb-10 budget-summary-row flex-column">
                    <!-- Circular Progress Bar on the left, bigger -->
                    <div class="d-flex flex-column align-c budget-progress-col">
                        <div class="budget-progress-circle">
                            <svg width="170" height="170" style="overflow: visible">
                                <circle cx="85" cy="85" r="80" stroke="#eee" stroke-width="14" fill="none"/>
                                <circle cx="85" cy="85" r="80" stroke="#dc3545" stroke-width="14" fill="none"
                                    stroke-dasharray="502"
                                    stroke-dashoffset="{{ 502 - (502 * ($budget['amount'] ? ($totalSpend * 100 / $budget['amount']) : 0) / 100) }}"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="budget-progress-percent">
                                {{ $budget['amount'] ? number_format(($totalSpend * 100 / $budget['amount']),2) : 0 }}%
                            </div>
                        </div>
                        <div class="fw-bold mt-10 budget-total-amount">
                            {{ number_format($budget['amount'],2) }} DH 
                        </div>
                        <div class="budget-total-label">Budget Total</div>
                    </div>
    
                    <!-- Budget Info on the right, smaller and organized in lines -->
                    <div class="budget-info d-flex flex-column justify-center">
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Budget Total:</span>
                            <span class="budget-info-value">{{ number_format($budget['amount'],2) }} DH</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Dépensé:</span>
                            <span class="budget-info-value budget-info-danger">{{ number_format($totalSpend) }} DH</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">% du budget:</span>
                            <span class="budget-info-value budget-info-danger">{{ $budget['amount'] ? (number_format($totalSpend * 100 / $budget['amount'],2)) : 0 }}%</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Saison:</span>
                            <span class="budget-info-value">{{ $budget['season'] }}</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Date d'ajout:</span>
                            <span class="budget-info-value">{{ $budget['created_at'] }}</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Dernière modification:</span>
                            <span class="budget-info-value">{{ $budget['updated_at'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lines-stats bg-white p-15 rad-6">
                <div class="d-flex s-between align-c mb-10">
                    <h2 class="m-15-0">Lignes Budgétaires</h2>
                    <button type="button" class="btn-primary bg-blue rad-6 d-flex align-c gap-5 pointer" id="addLineBtn">
                        <i class="fa-solid fa-plus"></i> <span class="hide-mobile">Ajouter</span>
                    </button>
                    <!-- Modal for adding new budget line -->
                    <div id="addLineModal" class="modal-overlay" style="display:none;">
                        <div class="modal-content bg-white p-20 rad-6" style="min-width:350px; max-width:95vw;">
                            <h3 class="mb-15">Ajouter une nouvelle ligne budgétaire</h3>
                            <form id="addLineForm" method="POST" action="{{ url('/lineBudget/add') }}">
                                @csrf
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineName">Nom de la ligne</label>
                                    <input type="text" class="form-control" id="lineName" name="name" required>
                                </div>
                                <div class="d-flex gap-10 mt-15">
                                    <button type="submit" class="btn-primary bg-blue rad-6 pointer">Ajouter</button>
                                    <button type="button" class="btn-primary bg-gray rad-6 pointer" id="closeAddLineModal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="budget-lines-list">
                    @foreach ($budgetLines as $budgetLine)
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">{{ $budgetLine['name']}}:</span>
                                <span>{{ $budgetLine['amount'] }} DH ({{$budgetLine['amount'] ? number_format(($budgetLine['spend'] * 100) / $budgetLine['amount'],2) : 0}}%)</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-bar-inner" data-percent="{{$budgetLine['amount'] ? ($budgetLine['spend'] * 100) / $budgetLine['amount'] : 0 }}" style="width: {{$budgetLine['amount'] ? ($budgetLine['spend'] * 100) / $budgetLine['amount'] : 0}}%;height: 100%;border-radius:0.375rem;"></div>
                            </div>
                            <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                                <span>Dépensé: <span class="budget-info-danger">{{ $budgetLine['spend'] }} DH</span></span>
                                <span>Restant: <span class="budget-info-success">{{ $budgetLine['amount'] - $budgetLine['spend'] }} DH</span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Budget Content  -->
    </div>
</div>
@endsection