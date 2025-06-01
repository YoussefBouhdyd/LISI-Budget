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
                <li class="active rad-6 tt-capital"><a href="{{ url('/admin-engagement') }}"><i class="fa-solid fa-file-signature fa-fw"></i><span class="hide-mobile">Engagements</span></a></li>
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
                <i class="fa-regular fa-bell fa-lg mr-20 p-relative"><span class="p-absolute rad-half"></span></i>
                <a href="profile.html"><img src="{{ asset('/imgs/user-profile.jpeg') }}" alt="user profile" class="rad-half"></a>
            </div>
        </div>
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
                        <td class="tt-capital">10 €</td>
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
                        <td class="tt-capital">25 €</td>
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
                        <td class="tt-capital">15 €</td>
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
                        <td class="tt-capital">30 €</td>
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
                        <td class="tt-capital">20 €</td>
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
