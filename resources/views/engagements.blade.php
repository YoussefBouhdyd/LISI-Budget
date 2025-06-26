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
        <h1 class="content-title">Engagements</h1>
        <!-- Start Engagements Content -->
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <h2 class="m-15-0">Engagements</h2>
                <div class="orders-table">
                    <table class="full-w txt-l">
                        <thead>
                            <tr class="bg-eee">
                                <th class="p-10">Émetteur</th>
                                <th class="p-10">Ligne Budgétaire</th>
                                <th class="p-10">Total Estimé</th>
                                <th class="p-10">Statut</th>
                                <th class="p-10">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($engagements as $engagement)
                                <tr class="status">
                                    <td class="tt-capital">{{$engagement->lineBudgetProposal->user->name}}</td>
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
                                    <td class="tt-capital d-flex align-c gap-5">
                                        test
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
        <!-- End Engagements Content  -->
    </div>
</div>
@endsection
