<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/sign', function () {
    return view('sign');
});

Route::get('/admin', function () {
    return view('dashboard');
});

Route::get('/admin-engagement', function () {
    return view('engagements');
});

Route::get('/transmitter', function () {
    return view('transmitter');
});

Route::get('/budget', function () {
    return view('budget');
});

Route::get('/bon_commande', function () {
    return view('bon_commande');
});

Route::get('/suivie_BC', function () {
    return view('suivie_BC');
});

Route::get('/profil_emetteur', function () {
    return view('profil_emetteur');
});
