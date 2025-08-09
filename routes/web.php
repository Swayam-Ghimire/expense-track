<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Guest\Landing;
use App\Livewire\Guest\Login;
use App\Livewire\Guest\Register;
use App\Livewire\Navigation\Create;
use App\Livewire\Navigation\Dashboard;
use App\Livewire\Navigation\Profile;
use App\Livewire\Navigation\Transaction;
use App\Livewire\Navigation\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing::class);
Route::middleware('guest')->group(function(){
    Route::get('/login', Login::class);
    Route::get('/register', Register::class);
    Route::controller(AuthController::class)->group(function(){
        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
    });
});

Route::middleware('auth')->group(function(){
    Route::get('/logout',[AuthController::class, 'logout']);
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transaction', Transaction::class)->name('transaction');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/create', Create::class)->name('create');
    Route::get('/edit/{transaction}', Edit::class)->name('edit');
});



