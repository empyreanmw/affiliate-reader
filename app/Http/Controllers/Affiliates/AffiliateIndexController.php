<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AffiliateIndexController extends Controller
{
    public function __invoke(): View
    {
        return view('affiliates');
    }
}
