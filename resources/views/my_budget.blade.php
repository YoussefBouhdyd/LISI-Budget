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
        <div class="section-content p-15">
            <div class="budget-stats bg-white p-15 rad-6 mb-20">
                <h2 class="m-15-0">Statistiques du Budget</h2>
                <div class="d-flex align-c mb-10 budget-summary-row column-mobil">
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
                    <h2 class="m-15-0">Lignes Budgétaires Approuvées</h2>
                </div>
                <div class="budget-lines-list">
                    <div class="orders-table">
                        <table class="full-w txt-l">
                            <thead>
                                <tr class="bg-eee">
                                    <th class="p-10">Code Rubrique</th>
                                    <th class="p-10">Ligne Budgétaire</th>
                                    <th class="p-10">Montant Proposé</th>
                                    <th class="p-10">Dépensé</th>
                                    <th class="p-10">Restant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($budgetLines->where('status','approved')->isEmpty())
                                    <tr>
                                        <td colspan="6" class="c-777">Aucune proposition trouvée.</td>
                                    </tr>
                                @else
                                    @foreach ($budgetLines->where('status','approved') as $budgetLine)
                                        <tr class="status">
                                            <td class="tt-capital">{{ $budgetLine->budgetLine->code }}</td>
                                            <td class="tt-capital">{{ $budgetLine->budgetLine->name }}</td>
                                            <td class="tt-capital">{{ $budgetLine->proposed_amount }}</td>
                                            <td class="tt-capital red-c">{{ $budgetLine->spend }}</td>
                                            <td class="tt-capital green-c">{{ $budgetLine->proposed_amount - $budgetLine->spend}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Budget Content  -->
    </div>
</div>
@endsection