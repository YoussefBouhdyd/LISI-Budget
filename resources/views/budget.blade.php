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
                                    <input type="number" step="0.01" min="0" class="form-control" id="budgetAmount" name="budgetAmount" value="10000000" required>
                                </div>
                                <div class="mb-10">
                                    <label for="budgetSaison" class="fw-bold">Saison</label>
                                    <input type="text" class="form-control" id="budgetSaison" name="budgetSaison" value="2024/2025" required>
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
                <div class="d-flex s-between align-c mb-10">
                    <h2 class="m-15-0">Lignes Budgétaires</h2>
                    <button type="button" class="btn-primary bg-blue rad-6 d-flex align-c gap-5 pointer" id="editLinesBtn">
                        <i class="fa-solid fa-pen"></i> <span class="hide-mobile">Modifier</span>
                    </button>
                    <!-- Modal for editing budget lines -->
                    <div id="editLinesModal" class="modal-overlay" style="display:none;">
                        <div class="modal-content bg-white p-20 rad-6" style="min-width:350px; max-width:95vw;">
                            <h3 class="mb-15">Modifier les lignes budgétaires</h3>
                            <form id="linesEditForm" method="POST" action="#">
                                @csrf
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineFonctionnement">Fonctionnement</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="lineFonctionnement" name="lineFonctionnement" value="1200000" required>
                                </div>
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineInvestissement">Investissement</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="lineInvestissement" name="lineInvestissement" value="800000" required>
                                </div>
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineMateriel">Matériel</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="lineMateriel" name="lineMateriel" value="500000" required>
                                </div>
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineServices">Services</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="lineServices" name="lineServices" value="300000" required>
                                </div>
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineMaintenance">Maintenance</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="lineMaintenance" name="lineMaintenance" value="150000" required>
                                </div>
                                <div class="mb-10">
                                    <label class="fw-bold" for="lineFormation">Formation</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="lineFormation" name="lineFormation" value="50000" required>
                                </div>
                                <div class="d-flex gap-10 mt-15">
                                    <button type="submit" class="btn-primary bg-blue rad-6 pointer">Enregistrer</button>
                                    <button type="button" class="btn-primary bg-gray rad-6 pointer" id="closeLinesModal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="budget-lines-list">
                    <!-- Ligne 1: >80% -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Fonctionnement:</span>
                            <span>1 200 000,00 DZD (85,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" data-percent="85" style="width: 85%; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">1 020 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">180 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 2: >50% -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Investissement:</span>
                            <span>800 000,00 DZD (60,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" data-percent="60" style="width: 60%; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">480 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">320 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 3: <50% -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Matériel:</span>
                            <span>500 000,00 DZD (35,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" data-percent="35" style="width: 35%; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">175 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">325 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 4: <50% -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Services:</span>
                            <span>300 000,00 DZD (20,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" data-percent="20" style="width: 20%; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">60 000,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">240 000,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 5: <50% -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Maintenance:</span>
                            <span>150 000,00 DZD (45,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" data-percent="45" style="width: 45%; height: 100%;"></div>
                        </div>
                        <div class="d-flex justify-between mt-5 gap-10 column-mobile align-c">
                            <span>Dépensé: <span class="budget-info-danger">67 500,00 DZD</span></span>
                            <span>Restant: <span class="budget-info-success">82 500,00 DZD</span></span>
                        </div>
                    </div>
                    <!-- Ligne 6: <50% -->
                    <div class="budget-line mb-20">
                        <div class="d-flex justify-between align-c mb-10 column-mobile">
                            <span class="fw-bold mr-10">Formation:</span>
                            <span>50 000,00 DZD (10,00%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" data-percent="10" style="width: 10%; height: 100%;"></div>
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