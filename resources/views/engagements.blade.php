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
                <table class="full-w txt-l">
                    <tr class="bg-eee ">
                        <th class="p-10">Émetteur</th>
                        <th class="p-10">Modifier le</th>
                        <th class="p-10">Prix</th>
                        <th class="p-10">Statut</th>
                        <th class="p-10">Détails</th>
                    </tr>
                    <tr>
                        <td class="tt-capital">Ilyas Ouzani</td>
                        <td class="tt-capital">10 Jun 2024</td>
                        <td class="tt-capital">10 DH</td>
                        <td class="tt-capital"><span class="btn-primary bg-orange"> En attente </span></td>
                        <td class="tt-capital">
                            <a href="#" class="btn-primary bg-blue">
                                <i class="fa-solid fa-eye mr-10"></i> Voir
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="tt-capital">Sara Benali</td>
                        <td class="tt-capital">08 Jun 2024</td>
                        <td class="tt-capital">25 DH</td>
                        <td class="tt-capital"><span class="btn-primary bg-green"> Accepté </span></td>
                        <td class="tt-capital">
                            <a href="#" class="btn-primary bg-blue">
                                <i class="fa-solid fa-eye mr-10"></i> Voir
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="tt-capital">Mohamed El Amrani</td>
                        <td class="tt-capital">05 Jun 2024</td>
                        <td class="tt-capital">15 DH</td>
                        <td class="tt-capital"><span class="btn-primary bg-red"> Refusé </span></td>
                        <td class="tt-capital">
                            <a href="#" class="btn-primary bg-blue">
                                <i class="fa-solid fa-eye mr-10"></i> Voir
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="tt-capital">Fatima Zahra</td>
                        <td class="tt-capital">12 Jun 2024</td>
                        <td class="tt-capital">30 DH</td>
                        <td class="tt-capital"><span class="btn-primary bg-orange"> En attente </span></td>
                        <td class="tt-capital">
                            <a href="#" class="btn-primary bg-blue">
                                <i class="fa-solid fa-eye mr-10"></i> Voir
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="tt-capital">Youssef Haddad</td>
                        <td class="tt-capital">09 Jun 2024</td>
                        <td class="tt-capital">20 DH</td>
                        <td class="tt-capital"><span class="btn-primary bg-green"> Accepté </span></td>
                        <td class="tt-capital">
                            <a href="#" class="btn-primary bg-blue">
                                <i class="fa-solid fa-eye mr-10"></i> Voir
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- End Engagements Content  -->
    </div>
</div>
@endsection
