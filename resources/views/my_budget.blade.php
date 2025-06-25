@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/framework.css') }}">
@endsection

@section('title', 'Engagements')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    @include('partials.sidebar_emetteur')
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
                </div>
                <div class="d-flex align-c mb-10 budget-summary-row flex-column">
                    <!-- Circular Progress Bar on the left, bigger -->
                    <div class="d-flex flex-column align-c budget-progress-col">
                        <div class="budget-progress-circle">
                            <svg width="170" height="170" style="overflow: visible">
                                <circle cx="85" cy="85" r="80" stroke="#eee" stroke-width="14" fill="none"/>
                                <circle cx="85" cy="85" r="80" stroke="#dc3545" stroke-width="14" fill="none"
                                    stroke-dasharray="502"
                                    stroke-dashoffset="{{ 502 - (502 * ($userData['budget'] ? ($totalSpend * 100 / $userData['budget']) : 0) / 100) }}"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="budget-progress-percent">
                                {{ $userData['budget'] ? number_format(($totalSpend * 100 / $userData['budget']),2) : 0 }}%
                            </div>
                        </div>
                        <div class="fw-bold mt-10 budget-total-amount">
                            {{ number_format($userData['budget'],2) }} DH 
                        </div>
                        <div class="budget-total-label">Budget Total</div>
                    </div>
    
                    <!-- Budget Info on the right, smaller and organized in lines -->
                    <div class="budget-info d-flex flex-column justify-center">
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Budget Total:</span>
                            <span class="budget-info-value">{{ number_format($userData['budget'],2) }} DH</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Dépensé:</span>
                            <span class="budget-info-value budget-info-danger">{{ number_format($totalSpend) }} DH</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">% du budget:</span>
                            <span class="budget-info-value budget-info-danger">{{ $userData['budget'] ? (number_format($totalSpend * 100 / $userData['budget'],2)) : 0 }}%</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Budget non spécifié à une ligne :</span>
                            <span class="budget-info-value green-c">{{ $userData['budget'] - $totalValidated }} DH</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Date d'ajout:</span>
                            <span class="budget-info-value">{{ $userData['created_at'] }}</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Dernière modification:</span>
                            <span class="budget-info-value">{{ $userData['updated_at'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lines-stats bg-white p-15 rad-6">
                <div class="d-flex s-between align-c mb-10">
                    <h2 class="m-15-0">Lignes Budgétaires</h2>
                </div>
                <div class="budget-lines-list">
                    @foreach ($budgetLines as $budgetLine)
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">{{ $budgetLine->budgetLine['name'] }}:</span>
                                @if ($budgetLine['status'] == 'approved')
                                    <span>{{ $budgetLine['proposed_amount'] }} DH ({{ $budgetLine['proposed_amount'] ? number_format(($budgetLine['spend'] * 100) / $budgetLine['proposed_amount'], 2) : 0 }}%)</span>
                                @else
                                    <span>0 DH (0%)</span>
                                @endif
                            </div>
                            <div class="progress-bar">
                                <div class="progress-bar-inner" data-percent="{{$budgetLine['proposed_amount'] ? ($budgetLine['spend'] * 100) / $budgetLine['proposed_amount'] : 0 }}" style="width: {{$budgetLine['proposed_amount'] ? ($budgetLine['spend'] * 100) / $budgetLine['proposed_amount'] : 0}}%;height: 100%;border-radius:0.375rem;"></div>
                            </div>
                            <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                                <span>Dépensé: <span class="budget-info-danger">{{ $budgetLine['spend'] }} DH</span></span>
                                <span>Restant: <span class="budget-info-success">{{ $budgetLine['proposed_amount'] - $budgetLine['spend'] }} DH</span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Budget Content  -->

        {{-- Start Budget Line Proposition  --}}
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <div class="orders-header">
                    <h2 class="m-15-0">Proposition De Ligne Budgétaire</h2>
                </div>
                
                <div class="orders-table">
                    <table class="full-w txt-l">
                        <thead>
                            <tr class="bg-eee">
                                <th class="p-10">Line Budgétaire</th>
                                <th class="p-10">Montant Proposé</th>
                                <th class="p-10">Statut</th>
                                <th class="p-10">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemple de bon en attente -->
                            @foreach ($budgetLines as $budgetLine)
                                <tr class="budget-line-prop">
                                    <td class="tt-capital">{{ $budgetLine->budgetLine['name'] }}</td>
                                    <td class="tt-capital">
                                        <input 
                                            class="p-10 rad-6 border proposed-amount-input" 
                                            type="number" 
                                            value="{{$budgetLine['proposed_amount']}}" 
                                            {{$budgetLine['status'] == 'approved' || $budgetLine['is_validated'] ? "disabled" : ""}}
                                            data-max="{{ $userData['budget'] - $totalValidated }}"
                                        > DH
                                    </td>
                                    <td class="tt-capital">
                                        @if ($budgetLine['status'] == 'pending')
                                            <span class="status-badge pending">
                                                <i class="fas fa-clock"></i> En attente
                                            </span>
                                        @elseif ($budgetLine['status'] == 'approved')
                                            <span class="status-badge approved">
                                                <i class="fas fa-check-circle"></i> Approuvé
                                            </span>
                                        @else
                                            <span class="status-badge rejected">
                                                <i class="fas fa-times-circle"></i> Rejeté
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tt-capital">
                                        @if ($budgetLine['is_validated'] == 1)
                                            <button class="btn-action bg-gray c-white no-hover" disabled>
                                                <i class="fas fa-check"></i> Valider
                                            </button>
                                        @else
                                            <button 
                                                data-line-id="{{$budgetLine['id']}}" 
                                                class="validate-btn btn-action btn-generate"
                                            >
                                                <i class="fas fa-check"></i> Valider
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    <div class="table-footer">
                        <div class="summary">
                            <span>Total: {{ $budgetLines->count() }} bons</span>
                            <span class="pending-count">{{ $budgetLines->where('status', 'pending')->count() }} en attente</span>
                            <span class="approved-count">{{ $budgetLines->where('status', 'approved')->count() }} approuvé</span>
                            <span class="rejected-count">{{ $budgetLines->where('status', 'rejected')->count() }} rejeté</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Budget Line Proposition  --}}
    </div>
</div>
<script src="{{ asset('js/my_budget.js') }}"></script>
@endsection