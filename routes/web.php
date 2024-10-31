<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\IpAddressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);

Route::get('ip-addresses', [IpAddressController::class, 'index']);
Route::get('ip-addresses/{id}', [IpAddressController::class, 'show']);

Route::get('campuses', [CampusController::class, 'index']);
Route::get('campuses/{id}', [CampusController::class, 'show']);

