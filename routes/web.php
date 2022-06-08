<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return inertia("Test");
});
Route::get('/test2', function () {
    return inertia("Test2");
});
