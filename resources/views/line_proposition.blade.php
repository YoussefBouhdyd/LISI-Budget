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
        <h1 class="content-title">Ligne Budgétaire</h1>        
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