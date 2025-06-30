<?php

use App\Http\Controllers\ItemController;
use App\Livewire\AccountRegister;
use App\Livewire\EditItems;
use App\Livewire\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; 
use App\Livewire\ItemForm;
use App\Livewire\ItemView;
use App\Livewire\ViewTransac;
use App\Livewire\Reports;

Route::get('/home', function () {
    return view('users');
})->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('login')->middleware('guest:admin');

// Admin logout route
Route::post('/logout', function() {
    Auth::guard('admin')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('admin.logout');



Route::middleware(['auth:admin'])->group(function () {
    Route::get('/form', ItemForm::class)->name('crud.form');
    Route::get('/fetch', ItemView::class)->name('crud.index');
    Route::get('/item/edit/{id}', ItemForm::class)->name('crud.edit');
    Route::get('/logs', ViewTransac::class)->name('crud.logs');
    Route::get('/register', AccountRegister::class)->name('crud.register');
    Route::get('/reports', Reports::class)->name('crud.reports');
    
});



Route::get('/add', function () {
    return view('crud.create');
})->name('crud.create');





Route::get('/borrow/{userId}', function ($userId) {
    return view('borrow', ['userId' => $userId]);
})->name('borrow');

Route::get('/return/{userId}', function ($userId) {
    return view('transactions', ['userId' => $userId]);
})->name('return');
