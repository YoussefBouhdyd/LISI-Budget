@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/framework.css') }}">
@endsection

@section('title', 'Proposition')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    @include('partials.sidebar')
    <!-- End Side Bar  -->
    <div class="content flex-1">
        <!-- Start Page header  -->
        @include('partials.header')
        <!-- End Page header  -->
        <h1 class="content-title">Proposition</h1>
        
        <!-- Start Proposition Content -->
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <div class="orders-header">
                    <h2 class="m-15-0">Proposition D’émetteur</h2>
                    
                    <!-- Filters integrated with the table header -->
                    <div class="filters-integrated">
                        <div class="filter-group">
                            <div class="status-filters d-flex gap-10">
                                <a href="{{ route('proposition.load',['status' => 'pending']) }}" class="status-filter-btn{{ request('status') == 'pending' ? ' active' : '' }}">En attente</a>
                                <a href="{{ route('proposition.load',['status' => 'approved']) }}" class="status-filter-btn{{ request('status') == 'approved' ? ' active' : '' }}">Approuvés</a>
                                <a href="{{ route('proposition.load',['status' => 'rejected']) }}" class="status-filter-btn{{ request('status') == 'rejected' ? ' active' : '' }}">Rejetés</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="orders-table">
                    <table class="full-w txt-l">
                        <thead>
                            <tr class="bg-eee">
                                <th class="p-10">Émetteur</th>
                                <th class="p-10">Date De Modification</th>
                                <th class="p-10">Ligne Budgétaire</th>
                                <th class="p-10">Montant Proposé</th>
                                <th class="p-10">Statut</th>
                                <th class="p-10">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($propositions as $proposition)
                                <tr class="status">
                                    <td class="tt-capital">{{$proposition->user->name}}</td>
                                    <td class="tt-capital">{{$proposition->updated_at}}</td>
                                    <td class="tt-capital">{{$proposition->budgetLine->name}}</td>
                                    <td class="tt-capital d-flex align-c gap-5"><input class="p-10 rad-6 border" type="number" value="{{$proposition['proposed_amount']}}" {{$proposition['status'] == 'approved' || $proposition['is_validated'] ? "disabled" : ""}}> DH</td>
                                    <td class="tt-capital">
                                        @if ($proposition->status === 'approved')
                                            <span class="status-badge approved">
                                                <i class="fas fa-check"></i> Approuvé
                                            </span>
                                        @elseif ($proposition->status === 'rejected')
                                            <span class="status-badge rejected">
                                                <i class="fas fa-times"></i> Rejeté
                                            </span>
                                        @else
                                            <span class="status-badge pending">
                                                <i class="fas fa-clock"></i> En attente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tt-capital d-flex align-c gap-5">
                                        @if (request('status') !== 'approved')
                                            <button class="accept-propo-btn btn-primary bg-green pointer" title="Accepter" data-id="{{$proposition->id}}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                        <button class="edit-propo-btn btn-primary bg-orange pointer" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if (request('status') !== 'rejected')
                                            <button class="reject-propo-btn btn-primary bg-red pointer" title="Rejeter" data-id="{{$proposition->id}}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
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
        <!-- End Budget Content  -->
    </div>
</div>
<script src="{{ asset('js/proposition.js') }}"></script>
@endsection