@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/framework.css') }}">
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
        <h1 class="content-title">Suivi des Expressions de Besoin</h1>
        <!-- Start User Need Expression -->
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <div class="orders-header">
                    <h2 class="m-15-0">Les Engagements Proposés</h2>
                    <div class="filters-integrated">
                        <div class="filter-group">
                            <div class="status-filters d-flex gap-10">
                                <a href="{{ route('need_expression.user',['status' => 'pending']) }}" class="status-filter-btn{{ request('status') == 'pending' ? ' active' : '' }}">En attente</a>
                                <a href="{{ route('need_expression.user',['status' => 'approved']) }}" class="status-filter-btn{{ request('status') == 'approved' ? ' active' : '' }}">Approuvés</a>
                                <a href="{{ route('need_expression.user',['status' => 'rejected']) }}" class="status-filter-btn{{ request('status') == 'rejected' ? ' active' : '' }}">Rejetés</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="orders-table">
                    <table class="full-w txt-l">
                        <thead>
                            <tr class="bg-eee">
                                <th class="p-10">Ligne Budgétaire</th>
                                <th class="p-10">Total Estimé</th>
                                <th class="p-10">Statut</th>
                                <th class="p-10">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($engagements as $engagement)
                                <tr class="status">
                                    <td class="tt-capital">{{$engagement->lineBudgetProposal->budgetLine->name}}</td>
                                    <td class="tt-capital">{{$engagement->needs->sum('estimated_amount')}}</td>
                                    <td class="tt-capital">
                                        @if ($engagement->status === 'approved')
                                            <span class="status-badge approved">
                                                <i class="fas fa-check"></i> Approuvé
                                            </span>
                                        @elseif ($engagement->status === 'rejected')
                                            <span class="status-badge rejected">
                                                <i class="fas fa-times"></i> Rejeté
                                            </span>
                                        @else
                                            <span class="status-badge pending">
                                                <i class="fas fa-clock"></i> En attente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tt-capital">
                                        <button class="view-need-btn btn-primary bg-blue pointer d-flex align-c gap-5" title="Voir les détails" data-id="{{ $engagement->id }}">
                                            <i class="fas fa-eye"></i> Consulter
                                        </button>
                                    </td>
                                </tr>
                                <tr class="engagement-details-row" id="engagement-details-{{ $engagement->id }}" style="display: none;">
                                    <td colspan="6">
                                        <div class="engagement-details">
                                            <h4 class="mb-5 sp-border p-5-10 text-center">Détails de l'engagement:</h4>
                                            <ul>
                                                @foreach($engagement->needs as $need)
                                                    <li class="sp-border p-5-10 mb-5">
                                                        <strong>Nature:</strong> {{ $need->nature }}<br>
                                                        <strong>Montant estimé:</strong> {{ $need->estimated_amount }} DH<br>
                                                        <strong>Description:</strong> {{ $need->description }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="c-777">Aucune proposition trouvée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End User Need Expression  -->
    </div>
</div>
<script src="{{ asset('js/track_need_expression.js') }}"></script>
@endsection
