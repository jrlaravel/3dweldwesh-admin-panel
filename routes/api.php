<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\InquiryController;


Route::get('products', [ApiController::class, 'products']);
Route::get('services', [ApiController::class, 'services']);
Route::get('testimonials', [ApiController::class, 'testimonials']);
Route::post('inquiry', [InquiryController::class, 'store']);