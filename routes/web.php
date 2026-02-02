<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


// testimonial
Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::post('store-testimonial', [TestimonialController::class, 'store'])->name('store-testimonial');
Route::get('delete-testimonial/{id}', [TestimonialController::class, 'delete'])->name('delete-testimonial');
Route::get('edit-testimonial/{id}', [TestimonialController::class, 'edit'])->name('edit-testimonial');
Route::post('update-testimonial', [TestimonialController::class, 'update'])->name('update-testimonial');


// product
Route::get('product', [ProductController::class, 'index'])->name('product');
Route::post('store-product', [ProductController::class, 'store'])->name('store-product');
Route::get('delete-product/{id}', [ProductController::class, 'delete'])->name('delete-product');
Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
Route::post('update-product', [ProductController::class, 'update'])->name('update-product');


// service
Route::get('service', [ServiceController::class, 'index'])->name('service');
Route::post('store-service', [ServiceController::class, 'store'])->name('store-service');
Route::get('delete-service/{id}', [ServiceController::class, 'delete'])->name('delete-service');
Route::get('edit-service/{id}', [ServiceController::class, 'edit'])->name('edit-service');
Route::post('update-service', [ServiceController::class, 'update'])->name('update-service');

// inquiry 
Route::get('inquiry', [InquiryController::class, 'index'])->name('inquiry');
