<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NeedExpressionController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\TransmitterController;
use App\Http\Controllers\UserBudgetController;
use App\Models\LineBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return view('home');
})->name('home');

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

    // Change Password Routes
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');

    // User Routes

    Route::get('/my-budget', UserBudgetController::class . "@loadUserBudget")
        ->name('userBudget.load');

    Route::post('/propose-line', UserBudgetController::class . "@proposBudgetLine");

    Route::get('/proposition/{status?}', [PropositionController::class, "loadPendingProposition"])
        ->name('proposition.load')
        ->where('status', 'pending|approved|rejected')
        ->defaults('status', 'pending');

    Route::post('/confirm-proposition', PropositionController::class . "@confirmProposition")
        ->name('proposition.confirm');
    
    Route::post('/reject-proposition', PropositionController::class . "@rejectProposition")
        ->name('proposition.reject');

    Route::get('/need_expression', NeedExpressionController::class . "@loadNeedExpression")->name('need_expression.load');

    Route::post('/submit-need-proposition', NeedExpressionController::class . "@storeNeedExpression")
        ->name('need_expression.store');

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
