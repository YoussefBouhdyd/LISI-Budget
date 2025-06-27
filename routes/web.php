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
    // Dashboard & Admin
    Route::get('/admin', DashboardController::class . "@loadSummarize");

    // Budget
    Route::get('/budget', BudgetController::class . "@loadBudget")->name('budget.load');
    Route::post('/lineBudget', BudgetController::class . '@updateLineBudget')->name('lineBudget.update');

    // User Budget
    Route::get('/my-budget', UserBudgetController::class . "@loadUserBudget")->name('userBudget.load');
    Route::post('/propose-line', UserBudgetController::class . "@proposBudgetLine");
    Route::post('/create-budget', UserBudgetController::class . "@createBudget")->name('userBudget.create');

    // Proposition
    Route::get('/proposition/{status?}', [PropositionController::class, "loadPendingProposition"])
        ->name('proposition.load')
        ->where('status', 'pending|approved|rejected')
        ->defaults('status', 'pending');
    Route::post('/confirm-proposition', PropositionController::class . "@confirmProposition")->name('proposition.confirm');
    Route::post('/reject-proposition', PropositionController::class . "@rejectProposition")->name('proposition.reject');

    // Need Expression
    Route::get('/need_expression', NeedExpressionController::class . "@loadNeedExpressionForm")->name('need_expression.load');
    Route::get('/track-expression/{status?}', NeedExpressionController::class . "@trackNeedExpression")
        ->name('need_expression.user')
        ->where('status', 'pending|approved|rejected')
        ->defaults('status', 'pending');
    Route::post('/submit-need-proposition', NeedExpressionController::class . "@storeNeedExpression")->name('need_expression.store');
    Route::get('/need-expression-admin/{status?}', NeedExpressionController::class . "@loadNeedExpressionAdmin")
        ->name('need_expression.admin')
        ->where('status', 'pending|approved|rejected')
        ->defaults('status', 'pending');
    Route::post('/approve-need-expression', NeedExpressionController::class . "@approveNeedExpression")->name('need_expression.approve');
    Route::post('/reject-need-expression', NeedExpressionController::class . "@rejectNeedExpression")->name('need_expression.reject');

    // Transmitter
    Route::get('/transmitter', TransmitterController::class . "@loadTransmitters")->name('transmitter.load');
    Route::post('/add-transmitter', TransmitterController::class . "@createNewTransmitter")->name('transmitter.create');
    Route::delete('/remove-transmitter', TransmitterController::class . "@deleteTransmitter")->name('transmitter.delete');
    Route::post('/update-transmitter', TransmitterController::class . "@updateTransmitter")->name('transmitter.update');
    Route::get('/transmitter-profile', function () {
        return view('profil_emetteur');
    });

    // Profile & Password
    Route::get('/profile', function () {
        return view('profile');
    });
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
});


// Authentication Routes

Route::get('/login', AuthController::class . "@loadSignIn")
    ->name('login');

Route::post('/login', AuthController::class . "@loginIn")
    ->name('auth.login');

Route::post('/logout', AuthController::class . "@logout")
    ->name('auth.logout')
    ->middleware('auth');
