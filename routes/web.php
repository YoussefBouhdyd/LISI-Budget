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

Route::get('/purchase-order', function () {
    return view('bon_commande');
});

Route::post('/purchase-order', function () {
    // Ajoute ici la logique de sauvegarde ou le contrôleur
    // Exemple : return 'Bon de commande enregistré !';
})->name('bon_commande.store');

Route::get('/order-tracking', function () {
    return view('suivie_BC');
});


Route::get('/transmitter-profile', function () {
    return view('profil_emetteur');
});
