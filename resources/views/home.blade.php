@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title', 'E-Intendance')

@section('content')
    <!-- Start Header  -->
    <header>
        <div class="container">
            <!-- the logo -->
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('imgs/icon.png') }}" alt="E-Intendance Logo">
                </a>
            </div>
            <!-- the links  -->
            <ul class="main-links">
                <li class="sign-btn"><a href="{{ route('login') }}">Connexion <i class="fa fa-user"></i></a></li>
            </ul>
        </div>
    </header>
    <!-- End Header  -->

    <div class="landing">
        <div class="container">
            <img src="{{ asset('imgs/deco1.webp') }}" alt="image">
            <div class="text">
                <h1>Gérez Facilement le Budget de <span class="highlight-red">LISI</span></h1>
                <p>
                    Bienvenue sur E-Intendance, la plateforme dédiée à la gestion des budgets de LISI. 
                    Notre objectif est de simplifier la gestion financière de l'entreprise en offrant des outils 
                    intuitifs et efficaces pour suivre les dépenses, planifier les budgets et optimiser les ressources.
                </p>
            </div>
        </div>
    </div>
@endsection