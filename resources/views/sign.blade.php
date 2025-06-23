@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sign.css') }}">
@endsection

@section('title', 'LISI - E-Intendance')

@section('content')

<div class="container">
<div class="left">
    <div class="logo-top">
        <img src="{{ asset('imgs/logoFssm.png') }}" alt="Logo of Moroccan Ministry of National Education and Vocational Training in Arabic and French" />
    </div>
    <div class="left-inner">
    <div class="logo-LISI">
        <img src="https://images.seeklogo.com/logo-png/35/1/lisi-logo-png_seeklogo-357728.png" alt="Logo LIST" />
    </div>
    <form action="{{ route('auth.login') }}" method="POST" autocomplete="off">
        @if($errors->any())
            <div style="color:red;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @csrf
        <input type="text" name="email" placeholder="Email" required/>
        <input type="password" name="password" placeholder="********" required/>
        <button type="submit">CONNEXION</button>
    </form>
    <div class="links">
        <a href="#">Mot de passe oublié ?</a>
    </div>
    </div>
</div>
<div class="right">
    <h1>Bienvenue dans votre<br />espace privé</h1>
    <p>
        la plateforme dédiée à la gestion des budgets de LISI. 
        Notre objectif est de simplifier la gestion financière de l'entreprise en offrant des outils 
        intuitifs et efficaces pour suivre les dépenses, planifier les budgets et optimiser les ressources.
    </p>
    <div class="illustration">
    <img src=" {{ asset('imgs/deco1.webp') }} " alt="decorator" />
    </div>
</div>
</div>

@endsection
