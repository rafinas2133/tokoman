<?php

use Illuminate\Support\Facades\Route;
use App\Models\DatabaseTest;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-database-connection', function () {
    return DatabaseTest::testConnection();
});