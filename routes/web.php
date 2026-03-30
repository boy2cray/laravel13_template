<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login',function() {return view('Pages.Auth.Login');})->name('login')->middleware('guest');
Route::get('/register',function() {return view('Pages.Auth.Register');})->name('register')->middleware('guest');
Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('Beranda.Dashboard');});

    Route::get('/karyawan',function() {return view('Pages.Karyawan.KaryawanView');})->name('data.karyawan')->middleware('is.su');
    Route::get('/admin',function() {return view('Pages.Admin.AdminView');})->name('data.admin')->middleware('is.su');
    Route::get('/profil',function() {return view('Pages.Karyawan.ProfilKaryawan');})->name('profil.karyawan');


});