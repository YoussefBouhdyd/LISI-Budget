<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\propositionController;
use App\Http\Controllers\TransmitterController;
use App\Http\Controllers\UserBudgetController;
use App\Models\LineBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return view('home');
});

// Admin Routes

Route::middleware('auth')->group(function () {
    Route::get('/admin', DashboardController::class . "@loadSummarize");

    Route::get('/admin-engagement', function () {
        return view('engagements');
    });

    Route::get('/transmitter', TransmitterController::class . "@loadTransmitters")
        ->name('transmitter.load');

    Route::post('/add-transmitter', TransmitterController::class . "@createNewTransmitter")
        ->name('transmitter.create');

    Route::delete('/remove-transmitter', TransmitterController::class . "@deleteTransmitter")
        ->name('transmitter.delete');

    Route::post('/update-transmitter', TransmitterController::class . "@updateTransmitter")
        ->name('transmitter.update');

    Route::get('/budget', BudgetController::class . "@loadBudget")
        ->name('budget.load');

    Route::post('/lineBudget', BudgetController::class . '@updateLineBudget')
        ->name('lineBudget.update');

    Route::get('/profile', function () {
        return view('profile');
    });

    // User Routes

    Route::get('/my-budget', UserBudgetController::class . "@loadUserBudget")
        ->name('userBudget.load');

    Route::post('/propose-line', UserBudgetController::class . "@proposBudgetLine");

    Route::get('/proposition/{status?}', [propositionController::class, "loadPendingProposition"])
        ->name('proposition.load')
        ->where('status', 'pending|approved|rejected')
        ->defaults('status', 'pending');

    Route::post('/confirm-proposition', propositionController::class . "@confirmProposition")
        ->name('proposition.confirm');

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
});

// Authentication Routes

Route::get('/login', AuthController::class . "@loadSignIn")
    ->name('login');

Route::post('/login', AuthController::class . "@loginIn")
    ->name('auth.login');

Route::post('/logout', AuthController::class . "@logout")
    ->name('auth.logout')
    ->middleware('auth');
