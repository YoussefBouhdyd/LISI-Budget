@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Engagements')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    <div class="side-bar p-relative bg-white p-20">
        <h1 class="logo txt-c p-relative">LISI</h1>
        <nav>
            <ul class="link">
                <li class="rad-6 tt-capital"><a href="{{ url('/admin') }}"><i class="fa-regular fa-chart-bar fa-fw"></i><span class="hide-mobile">Dashboard</span></a></li>
                <li class="rad-6 tt-capital"><a href="{{ url('/admin-engagement') }}"><i class="fa-solid fa-file-signature fa-fw"></i><span class="hide-mobile">Engagements</span></a></li>
                <li class="rad-6 tt-capital"><a href="{{ url('/transmitter') }}"><i class="fa-solid fa-paper-plane fa-fw"></i><span class="hide-mobile">Émetteur</span></a></li>
                <li class="active rad-6 tt-capital"><a href="{{ url('/budget') }}"><i class="fa-solid fa-wallet fa-fw"></i><span class="hide-mobile">Budget</span></a></li>
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
                <i class="fa-regular fa-bell fa-lg mr-20 p-relative"><span class="p-absolute rad-half"></span></i>
                <a href="profile.html"><img src="{{ asset('/imgs/user-profile.jpeg') }}" alt="user profile" class="rad-half"></a>
            </div>
        </div>
        <!-- End Page header  -->
        <h1 class="content-title">Budget</h1>

        <!-- Start Budget Content -->
        <div class="section-content p-15 d-flex gap-10 column-mobile">
            <div class="budget-stats bg-white p-15 rad-6">
                <h2 class="m-15-0">Budget Statics</h2>
                <div class="d-flex align-c mb-10 budget-summary-row flex-column">
                    <!-- Circular Progress Bar on the left, bigger -->
                    <div class="d-flex flex-column align-c budget-progress-col">
                        <div class="budget-progress-circle">
                            <svg width="170" height="170" style="overflow: visible">
                                <circle cx="85" cy="85" r="80" stroke="#eee" stroke-width="14" fill="none"/>
                                <circle cx="85" cy="85" r="80" stroke="#dc3545" stroke-width="14" fill="none"
                                    stroke-dasharray="502"
                                    stroke-dashoffset="{{ 502 - (502 * 25 / 100) }}"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="budget-progress-percent">
                                25,00%
                            </div>
                        </div>
                        <div class="fw-bold mt-10 budget-total-amount">
                            10 000 000,00 DZD
                        </div>
                        <div class="budget-total-label">Budget Total</div>
                    </div>
    
                    <!-- Budget Info on the right, smaller and organized in lines -->
                    <div class="budget-info d-flex flex-column justify-center">
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Budget Total:</span>
                            <span class="budget-info-value">10 000 000,00 DZD</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Dépensé:</span>
                            <span class="budget-info-value budget-info-danger">2 500 000,00 DZD</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">% du budget:</span>
                            <span class="budget-info-value budget-info-danger">25,00%</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Saison:</span>
                            <span class="budget-info-value">2024/2025</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Date d'ajout:</span>
                            <span class="budget-info-value">01/07/2024</span>
                        </div>
                        <div class="d-flex justify-between budget-info-row">
                            <span class="fw-bold budget-info-label">Dernière modification:</span>
                            <span class="budget-info-value">15/07/2024</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lines-stats bg-white p-15 rad-6">
                <h2 class="m-15-0">Lignes Budgétaires</h2>
                <div class="budget-lines-list">
                    <!-- Ligne 1 -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Fonctionnement:</span>
                            <span>1 200 000,00 DZD (40,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div style="width: 40%; background: #007bff; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">200 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">1 000 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 2 -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Investissement:</span>
                            <span>800 000,00 DZD (26,67%)</span>
                        </div>
                        <div class="progress-bar">
                            <div style="width: 26.67%; background: #28a745; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">300 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">500 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 3 -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Matériel:</span>
                            <span>500 000,00 DZD (16,67%)</span>
                        </div>
                        <div class="progress-bar">
                            <div style="width: 16.67%; background: #ffc107; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">100 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">400 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 4 -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Services:</span>
                            <span>300 000,00 DZD (10,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div style="width: 10%; background: #17a2b8; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">50 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">250 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 5 -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Maintenance:</span>
                            <span>150 000,00 DZD (5,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div style="width: 5%; background: #6f42c1; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">20 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">130 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 6 -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Formation:</span>
                            <span>50 000,00 DZD (1,67%)</span>
                        </div>
                        <div class="progress-bar">
                            <div style="width: 1.67%; background: #fd7e14; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">5 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">45 000,00 DZD</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Budget Content  -->
    </div>
</div>
@endsection