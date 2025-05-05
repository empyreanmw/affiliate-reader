<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Affiliates\AffiliateUploadRequest;
use App\Services\AffiliateRetrievalService;
use Illuminate\Contracts\View\View;

class AffiliateUploadController extends Controller
{
    private const DUBLIN_LONGITUDE = -6.2535495;
    private const DUBLIN_LATITUDE = 53.3340285;

    public function __invoke(AffiliateUploadRequest $request, AffiliateRetrievalService $affiliateRetrievalService): View
    {
        $file = $request->file('affiliate_file');

        return view('affiliates', [
            'affiliates' => $affiliateRetrievalService->getNearbyAffiliates(
                $file,
                self::DUBLIN_LATITUDE,
                self::DUBLIN_LONGITUDE
            )
        ]);
    }
}
