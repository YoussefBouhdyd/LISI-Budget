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
                <li class="active rad-6 tt-capital"><a href="{{ url('/transmitter') }}"><i class="fa-solid fa-paper-plane fa-fw"></i><span class="hide-mobile">Émetteur</span></a></li>
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
                <i class="fa-regular fa-bell fa-lg mr-20 p-relative"><span class="p-absolute rad-half"></span></i>
                <a href="profile.html"><img src="{{ asset('/imgs/user-profile.jpeg') }}" alt="user profile" class="rad-half"></a>
            </div>
        </div>
        <!-- End Page header  -->
        <h1 class="content-title">Émetteurs</h1>

        <!-- Start Engagements Content -->
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <div class="d-flex flex-between align-c mb-10">
                    <h2 class="m-15-0">List D’émetteur</h2>
                    <button class="btn primary-button rad-6 bg-blue pointer p-10" id="openModalBtn">
                        <i class="fa-solid fa-plus fa-fw"></i> Ajouter un émetteur
                    </button>
                </div>
                <table class="full-w txt-l">
                    <tr class="bg-eee ">
                        <th class="p-10">Nom de l'émetteur</th>
                        <th class="p-10">Budget</th>
                        <th class="p-10">Date de création</th>
                        <th class="p-10">Profession</th>
                        <th class="p-10">Actions</th>
                    </tr>
                    <tr>
                        <td class="p-10">Jean Dupont</td>
                        <td class="p-10">120,000 €</td>
                        <td class="p-10">2022-03-15</td>
                        <td class="p-10">Comptable</td>
                        <td class="p-10 d-flex">
                            <button class="primary-button bg-orange c-white rad-6 p-5 pointer d-inline-flex align-c edit-btn" title="Modifier" style="border:none; min-width: 40px; gap: 5px;" 
                                data-name="Jean Dupont" 
                                data-budget="120000" 
                                data-date="2022-03-15" 
                                data-profession="Comptable">
                                <i class="fa-solid fa-pen"></i>
                                <span class="hide-mobile">Modifier</span>
                            </button>
                            <button class="primary-button bg-red c-white rad-6 p-5 pointer d-inline-flex align-c delete-btn" title="Supprimer" style="border:none; min-width: 40px; gap: 5px; margin-left: 8px;">
                                <i class="fa-solid fa-trash"></i>
                                <span class="hide-mobile">Supprimer</span>
                            </button>
                        </td>
                    </tr>
                </table>

                <!-- Edit Transmitter Modal -->
                <div id="editTransmitterModal" class="modal">
                    <div class="modal-content">
                        <h3 class="mb-20">Modifier l'émetteur</h3>
                        <form id="editTransmitterForm">
                            <div class="mb-15">
                                <label for="edit_name">Nom de l'émetteur</label>
                                <input type="text" id="edit_name" name="name" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="mb-15">
                                <label for="edit_budget">Budget</label>
                                <input type="number" id="edit_budget" name="budget" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="mb-15">
                                <label for="edit_date">Date de création</label>
                                <input type="date" id="edit_date" name="date" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="mb-15">
                                <label for="edit_profession">Profession</label>
                                <input type="text" id="edit_profession" name="profession" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="d-flex flex-end" style="gap: 10px;">
                                <button type="button" id="cancelEditBtn" class="primary-button bg-grey rad-6 p-10 pointer">Annuler</button>
                                <button type="submit" class="primary-button bg-blue rad-6 p-10 pointer c-white">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Model for Adding a new transmitter --}}
                <div id="transmitterModal" class="modal">
                    <div class="modal-content">
                        <span id="closeModalBtn">&times;</span>
                        <h3 class="mb-20">Ajouter un émetteur</h3>
                        <form>
                            <div class="mb-15">
                                <label for="name">Nom de l'émetteur</label>
                                <input type="text" id="name" name="name" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="mb-15">
                                <label for="budget">Budget</label>
                                <input type="number" id="budget" name="budget" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="mb-15">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <div class="mb-15">
                                <label for="profession">Profession</label>
                                <input type="text" id="profession" name="profession" class="full-w p-10 rad-6 sp-border" required>
                            </div>
                            <button type="submit" class="primary-button bg-blue rad-6 p-10 pointer c-white m-auto">Enregistrer</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteConfirmModal" class="modal">
                    <div class="modal-content delete-modal-content">
                        <h3 class="mb-20">Confirmer la suppression</h3>
                        <p>Êtes-vous sûr de vouloir supprimer cet émetteur ?</p>
                        <div class="d-flex flex-end delete-modal-actions">
                            <button id="cancelDeleteBtn" class="primary-button bg-grey rad-6 p-10 pointer">Annuler</button>
                            <button id="confirmDeleteBtn" class="primary-button bg-red c-white rad-6 p-10 pointer">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Engagements Content  -->
    </div>
</div>
@endsection