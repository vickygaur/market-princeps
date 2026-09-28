<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
