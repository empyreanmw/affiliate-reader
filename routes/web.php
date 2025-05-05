<?php

use App\Http\Controllers\Affiliates\AffiliateIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', AffiliateIndexController::class)->name('index');
