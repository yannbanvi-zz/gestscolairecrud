<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return inertia("Test");
})->name("home");

Route::get('/contact', function () {
    return inertia("Test2");
})->name("contact");
