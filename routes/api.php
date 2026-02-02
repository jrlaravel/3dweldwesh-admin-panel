<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('products', [ApiController::class, 'products']);
Route::get('services', [ApiController::class, 'services']);
Route::get('testimonials', [ApiController::class, 'testimonials']);
