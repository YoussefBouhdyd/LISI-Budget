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
        <h1 class="content-title">Émetteurs</h1>

        <!-- Start Engagements Content -->
        <div class="section-content p-15">
            <div class="projects bg-white rad-6 p-15">
                <div class="d-flex flex-between align-c mb-10">
                    <h2 class="m-15-0">List D’émetteur</h2>
                    <button class="btn btn-primary rad-6 bg-blue pointer p-10" id="openModalBtn">
                        <i class="fa-solid fa-plus fa-fw"></i> Ajouter un émetteur
                    </button>
                </div>
                {{-- Success & Error Messages --}}
                @if(session('success'))
                    <div class="alert alert-success custom-alert" style="margin: 15px; position: relative;">
                        <span class="close-alert" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger custom-alert" style="margin: 15px; position: relative;">
                        <span class="close-alert" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{ session('error') }}
                    </div>
                @endif
                @if(count($users) > 0)
                    <table class="full-w txt-l">
                        <tr class="bg-eee ">
                            <th class="p-10">Nom de l'émetteur</th>
                            <th class="p-10">Budget</th>
                            <th class="p-10">Dépensé</th>
                            <th class="p-10">Reste</th>
                            <th class="p-10">Profession</th>
                            <th class="p-10">Email</th>
                            <th class="p-10">Actions</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-10">{{ $user['name'] }}</td>
                                <td class="p-10">{{ $user['budget'] }} DH</td>
                                <td class="p-10 red-c">{{ $user['spend'] }}DH</td>
                                <td class="p-10 green-c">{{ $user['budget'] - $user['spend']   }} DH</td>
                                <td class="p-10">{{ $user['profession'] }}</td>
                                <td class="p-10">{{ $user['email'] }}</td>
                                <td class="p-10 d-flex">
                                    <button class="btn-primary bg-orange c-white rad-6 p-5 pointer d-inline-flex align-c edit-btn" title="Modifier" style="border:none; min-width: 40px; gap: 5px;" 
                                        data-name="{{ $user['name'] }}" 
                                        data-budget="{{ $user['budget'] }}" 
                                        data-profession="{{ $user['profession'] }} "
                                        data-email ="{{ $user['email'] }}"
                                        data-id="{{ $user['id'] }}">
                                        <i class="fa-solid fa-pen"></i>
                                        <span class="hide-mobile">Modifier</span>
                                    </button>
                                    <button data-id="{{ $user['id']}}" class="btn-primary bg-red c-white rad-6 p-5 pointer d-inline-flex align-c delete-btn" title="Supprimer" style="border:none; min-width: 40px; gap: 5px; margin-left: 8px;">
                                        <i class="fa-solid fa-trash"></i>
                                        <span class="hide-mobile">Supprimer</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="p-15 text-center c-777">Aucun émetteur trouvé.</p>
                @endif

                <!-- Edit Transmitter Modal -->
                <div id="editTransmitterModal" class="modal">
                    <div class="modal-content">
                        <h3 class="mb-20">Modifier l'émetteur</h3>
                        <form id="editTransmitterForm" method="POST" action="{{ url('/update-transmitter') }}">
                            @csrf
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-15">
                                <label for="edit_name">Nom de l'émetteur</label>
                                <input type="text" id="edit_name" name="name" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="mb-15">
                                <label for="edit_budget">Budget</label>
                                <input type="number" id="edit_budget" name="budget" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="mb-15">
                                <label for="edit_email">Email</label>
                                <input type="email" id="edit_email" name="email" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="mb-15">
                                <label for="edit_profession">Profession</label>
                                <input type="text" id="edit_profession" name="profession" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="d-flex flex-end" style="gap: 10px;">
                                <button type="button" id="cancelEditBtn" class="btn-primary bg-gray rad-6 p-10 pointer">Annuler</button>
                                <button type="submit" class="btn-primary bg-blue rad-6 p-10 pointer c-white">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Model for Adding a new transmitter --}}
                <div id="transmitterModal" class="modal">
                    <div class="modal-content">
                        <span id="closeModalBtn">&times;</span>
                        <h3 class="mb-20">Ajouter un émetteur</h3>
                        <form method="POST" action="{{ url('/add-transmitter') }}">
                            @csrf
                            <div class="mb-15">
                                <label for="name">Nom de l'émetteur</label>
                                <input type="text" id="name" name="name" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="mb-15">
                                <label for="budget">Budget</label>
                                <input type="number" id="budget" name="budget" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="mb-15">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <div class="mb-15">
                                <label for="profession">Profession</label>
                                <input type="text" id="profession" name="profession" class="full-w p-10 rad-6 form-control" required>
                            </div>
                            <button type="submit" class="btn-primary bg-blue rad-6 p-10 pointer c-white m-auto">Enregistrer</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteConfirmModal" class="modal">
                    <div class="modal-content delete-modal-content">
                        <h3 class="mb-20">Confirmer la suppression</h3>
                        <p>Êtes-vous sûr de vouloir supprimer cet émetteur ?</p>
                        <div class="d-flex flex-end delete-modal-actions">
                            <button id="cancelDeleteBtn" class="btn-primary bg-gray rad-6 p-10 pointer">Annuler</button>
                            <button id="confirmDeleteBtn" class="btn-primary bg-red c-white rad-6 p-10 pointer">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Engagements Content  -->
    </div>
</div>
@endsection