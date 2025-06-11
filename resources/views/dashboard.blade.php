@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Dashboard')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    @include('partials.sidebar')
    <!-- End Side Bar  -->
    <div class="content flex-1">
        <!-- Start Page header  -->
        @include('partials.header')
        <!-- End Page header  -->
        <h1 class="content-title">dashboard</h1>
        <!-- Start Dashboard Content -->
        <div class="section-content p-15 grid-400">
            <!-- Start Welcome  -->
            <div class="box bg-white rad-6">
                <div class="head d-flex s-between p-15 bg-eee p-relative" >
                    <div class="greeting">
                        <h2 class="m-15-0">Welcome</h2>
                        <span>Youssef</span>
                    </div>
                    <div class="image">
                        <img src="{{ asset('/imgs/welcome.png') }}" alt="welcome" class="mw-100">
                    </div>
                    <img src="{{ asset('/imgs/user-profile.svg')}}" alt="user-profile" class="p-absolute rad-half mw-100">
                </div>
                <div class="sumrise d-flex s-around p-15 text-center">
                    <div class="col">
                        <h4>Youssef Bouhdyd</h4>
                        <span class="tt-capital">Admin</span>
                    </div>
                    <div class="col">
                        <h4>Enseignement</h4>
                        <span class="tt-capital">Profession</span>
                    </div>
                </div>
            </div>
            <!-- End Welcome  -->
            
            <!-- Start Budget Summarize  -->
            <div class="box bg-white rad-6 p-15">
                <h2 class="m-15-0">Budget</h2>
                <p class="tt-capital c-777">Résumé du budget de l'année en cours</p>
                <div class="d-flex flex-column align-c budget-progress-col mt-15">
                    <div class="budget-progress-circle">
                        <svg width="170" height="170" style="overflow: visible">
                            <circle cx="85" cy="85" r="80" stroke="#eee" stroke-width="14" fill="none"/>
                            <circle cx="85" cy="85" r="80" stroke="#dc3545" stroke-width="14" fill="none"
                                stroke-dasharray="502"
                                stroke-dashoffset="{{ 502 - (502 * 25 / 100) }}"
                                stroke-linecap="round"
                            />
                        </svg>
                        <div class="budget-progress-percent">25,00%</div>
                    </div>
                    <div class="fw-bold mt-10 budget-total-amount">10 000 000,00 DZD </div>
                    <div class="budget-total-label">Budget Total</div>
                </div>
            </div>
            <!-- End Budget Summarize   -->
            
            <!-- Start Engagement -->
            <div class="box bg-white rad-6 p-15">
                <h2 class="m-15-0">Engagement</h2>
                <p class="tt-capital c-777">Résumé des engagements en cours pour cette année</p>
                <div class="engagement-list-wrapper">
                    <div class="engagement-list mt-15">
                        <div class="engagement-header d-flex bg-eee p-10 fw-bold">
                            <div class="flex-1">Émetteur</div>
                            <div class="flex-1">Prix</div>
                            <div class="flex-1">Statut</div>
                            <div class="flex-1">Détails</div>
                        </div>
                        <div class="engagement-row d-flex align-c p-10">
                            <div class="flex-1 tt-capital">Ilyas Ouzani</div>
                            <div class="flex-1 tt-capital">10 €</div>
                            <div class="flex-1 tt-capital">
                                <span class="btn-primary bg-orange">En attente</span>
                            </div>
                            <div class="flex-1 tt-capital">
                                <a href="#" class="btn-primary bg-blue">
                                    <i class="fa-solid fa-eye mr-10"></i> Voir
                                </a>
                            </div>
                        </div>
                        <div class="engagement-row d-flex align-c p-10">
                            <div class="flex-1 tt-capital">Sara Benali</div>
                            <div class="flex-1 tt-capital">25 €</div>
                            <div class="flex-1 tt-capital">
                                <span class="btn-primary bg-orange">En attente</span>
                            </div>
                            <div class="flex-1 tt-capital">
                                <a href="#" class="btn-primary bg-blue">
                                    <i class="fa-solid fa-eye mr-10"></i> Voir
                                </a>
                            </div>
                        </div>
                        <div class="engagement-row d-flex align-c p-10">
                            <div class="flex-1 tt-capital">Amine Boudiaf</div>
                            <div class="flex-1 tt-capital">50 €</div>
                            <div class="flex-1 tt-capital">
                                <span class="btn-primary bg-orange">En attente</span>
                            </div>
                            <div class="flex-1 tt-capital">
                                <a href="#" class="btn-primary bg-blue">
                                    <i class="fa-solid fa-eye mr-10"></i> Voir
                                </a>
                            </div>
                        </div>
                        <div class="engagement-row d-flex align-c p-10">
                            <div class="flex-1 tt-capital">Nadia Khelifi</div>
                            <div class="flex-1 tt-capital">75 €</div>
                            <div class="flex-1 tt-capital">
                                <span class="btn-primary bg-orange">En attente</span>
                            </div>
                            <div class="flex-1 tt-capital">
                                <a href="#" class="btn-primary bg-blue">
                                    <i class="fa-solid fa-eye mr-10"></i> Voir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Engagement  -->
            
            <!-- Start Émetteur -->
            <div class="box bg-white rad-6 p-15">
                <h2 class="m-15-0">Émetteur</h2>
                <p class="tt-capital c-777">Résumé des dépenses et soldes par émetteur pour l'année en cours</p>
                <div class="mt-15">
                    <div class="emetteur-header d-flex bg-eee p-10 fw-bold">
                        <div class="flex-1">Émetteur</div>
                        <div class="flex-1">Dépensé</div>
                        <div class="flex-1">Restant</div>
                    </div>
                    <div class="emetteur-row d-flex align-c p-10">
                        <div class="flex-1 tt-capital">Ilyas Ouzani</div>
                        <div class="flex-1 red-c">2 000 €</div>
                        <div class="flex-1 green-c">8 000 €</div>
                    </div>
                    <div class="emetteur-row d-flex align-c p-10">
                        <div class="flex-1 tt-capital">Sara Benali</div>
                        <div class="flex-1 red-c">1 500 €</div>
                        <div class="flex-1 green-c">3 500 €</div>
                    </div>
                    <div class="emetteur-row d-flex align-c p-10">
                        <div class="flex-1 tt-capital">Amine Boudiaf</div>
                        <div class="flex-1 red-c">3 000 €</div>
                        <div class="flex-1 green-c">7 000 €</div>
                    </div>
                    <div class="emetteur-row d-flex align-c p-10">
                        <div class="flex-1 tt-capital">Nadia Khelifi</div>
                        <div class="flex-1 red-c">500 €</div>
                        <div class="flex-1 green-c">9 500 €</div>
                    </div>
                </div>

            </div>
            <!-- End Émetteur  -->
            
            <!-- Start Lignes Budgétaire -->
            <div class="box bg-white rad-6 p-15">
                <h2 class="m-15-0">Lignes Budgétaire</h2>
                <div class="lines-stats">
                    <div class="budget-lines-list">
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">Fonctionnement:</span>
                            </div>
                            <div class="progress-bar p-relative">
                                <div class="progress-bar-inner" data-percent="85" style="width: 85%; height: 100%;"></div>
                                <span class="tooltip" style="left: 85%">85%</span>
                            </div>
                        </div>
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">Investissement:</span>
                            </div>
                            <div class="progress-bar p-relative">
                                <div class="progress-bar-inner" data-percent="60" style="width: 60%; height: 100%;"></div>
                                <span class="tooltip" style="left: 60%">60%</span>
                            </div>
                        </div>
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">Recherche:</span>
                            </div>
                            <div class="progress-bar p-relative">
                                <div class="progress-bar-inner" data-percent="40" style="width: 40%; height: 100%;"></div>
                                <span class="tooltip" style="left: 40%">40%</span>
                            </div>
                        </div>
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">Formation:</span>
                            </div>
                            <div class="progress-bar p-relative">
                                <div class="progress-bar-inner" data-percent="72" style="width: 72%; height: 100%;"></div>
                                <span class="tooltip" style="left: 72%">72%</span>
                            </div>
                        </div>
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">Maintenance:</span>
                            </div>
                            <div class="progress-bar p-relative">
                                <div class="progress-bar-inner" data-percent="95" style="width: 95%; height: 100%;"></div>
                                <span class="tooltip" style="left: 95%">95%</span>
                            </div>
                        </div>
                        <div class="budget-line mb-20">
                            <div class="d-flex justify-between align-c mb-10 column-mobile">
                                <span class="fw-bold mr-10">Développement:</span>
                            </div>
                            <div class="progress-bar p-relative">
                                <div class="progress-bar-inner" data-percent="15" style="width: 15%; height: 100%;"></div>
                                <span class="tooltip" style="left: 15%">15%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Lignes Budgétaire -->

        </div>
        <!-- End Dashboard Content  -->
    </div>
</div>
@endsection




