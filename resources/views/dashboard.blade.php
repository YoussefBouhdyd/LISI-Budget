@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Dashboard')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    <div class="side-bar p-relative bg-white p-20">
        <h1 class="logo txt-c p-relative">LISI</h1>
        <nav>
            <ul class="link">
                <li class="active rad-6 tt-capital"><a href="{{ url('/admin') }}"><i class="fa-regular fa-chart-bar fa-fw"></i><span class="hide-mobile">Dashboard</span></a></li>
                <li class="rad-6 tt-capital"><a href="{{ url('/admin-engagement') }}"><i class="fa-solid fa-file-signature fa-fw"></i><span class="hide-mobile">Engagements</span></a></li>
                <li class="rad-6 tt-capital"><a href="{{ url('/transmitter') }}"><i class="fa-solid fa-paper-plane fa-fw"></i><span class="hide-mobile">Émetteur</span></a></li>
                <li class="rad-6 tt-capital"><a href="{{ url('/budget') }}"><i class="fa-solid fa-wallet fa-fw"></i><span class="hide-mobile">Budget</span></a></li>
                <li class="rad-6 tt-capital"><a href="setting.html"><i class="fa-solid fa-gear fa-fw"></i><span class="hide-mobile">Paramètre</span></a></li>
                <li class="rad-6 tt-capital"><a href="profile.html"><i class="fa-regular fa-user fa-fw"></i><span class="hide-mobile">Profil</span></a></li>
            </ul>
        </nav>
    </div>
    <!-- End Side Bar  -->
    <div class="content flex-1">
        <!-- Start Page header  -->
        <div class="header d-flex p-20 flex-end align-c bg-white p-relative">
            <div class="profile flex-between">
                <button id="notification-btn" class="notification-btn">
                    <i class="fa-regular fa-bell fa-lg mr-20 p-relative">
                        <span class="notification-dot"></span>
                    </i>
                </button>
                <div id="notification-box" class="notification-box">
                    <div class="notification-header">
                        Notifications
                    </div>
                    <div class="notification-content" style="padding:0;">
                        <ul class="notification-list" id="notification-list">
                            <li>
                                <span class="notif-title">Nouvelle demande d'engagement</span>
                                <span class="notif-time">il y a 2 min</span>
                                <span class="notif-eye" title="Marquer comme lu">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </li>
                            <li>
                                <span class="notif-title">Budget mis à jour</span>
                                <span class="notif-time">il y a 10 min</span>
                                <span class="notif-eye" title="Marquer comme lu">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </li>
                            <li>
                                <span class="notif-title">Profil modifié avec succès</span>
                                <span class="notif-time">il y a 1 heure</span>
                                <span class="notif-eye" title="Marquer comme lu">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn = document.getElementById('notification-btn');
                            const box = document.getElementById('notification-box');
                            btn.addEventListener('click', function (e) {
                                e.stopPropagation();
                                box.style.display = box.style.display === 'none' || box.style.display === '' ? 'block' : 'none';
                            });
                            document.addEventListener('click', function () {
                                box.style.display = 'none';
                            });
                            box.addEventListener('click', function(e) {
                                e.stopPropagation();
                            });

                            // Remove notification on eye icon click
                            document.querySelectorAll('.notif-eye').forEach(function(eye) {
                                eye.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    const li = this.closest('li');
                                    if (li) li.remove();
                                });
                            });
                        });
                    </script>
                <a href="profile.html"><img src="{{ asset('/imgs/user-profile.jpeg') }}" alt="user profile" class="rad-half"></a>
            </div>
        </div>
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
                    <img src="{{ asset('/imgs/user-profile.jpeg')}}" alt="user-profile" class="p-absolute rad-half mw-100">
                </div>
                <div class="sumrise d-flex s-around p-15 txt-c">
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




