<?php

use App\Http\Controllers\Affiliates\AffiliateIndexController;
use App\Http\Controllers\Affiliates\AffiliateUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', AffiliateIndexController::class)->name('index');
Route::post('/', AffiliateUploadController::class)->name('affiliate-upload');
