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
    return view('purchase_order');
});

Route::get('/order-tracking', function () {
    return view('suivie_BC');
});


Route::get('/transmitter-profile', function () {
    return view('transmitter_profile');
});
