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
                <i class="fa-regular fa-bell fa-lg mr-20 p-relative"><span class="p-absolute rad-half"></span></i>
                <a href="profile.html"><img src="{{ asset('/imgs/user-profile.jpeg') }}" alt="user profile" class="rad-half"></a>
            </div>
        </div>
        <!-- End Page header  -->
        <h1 class="content-title">dashboard</h1>
        <!-- Start Dashboard Content -->
        <!-- End Dashboard Content  -->
    </div>
</div>
@endsection




