<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('auth.login');
});
Route::get('/register', function(){
    return view('auth.register');
});
Route::get('/dashboard', function(){
    return view('dashboard');
});
Route::get('/sidebar', function(){
    return view('partials.sidebar');
});
Route::get('/admin-show', function(){
    return view('admin.index');
});
Route::get('/admin-akun', function(){
    return view('admin.AdminAcount');
});
Route::get('/masyarakat-akun', function(){
    return view('masyarakat.index');
});
Route::get('/petugas-laporan', function(){
    return view('petugas.index');
});




