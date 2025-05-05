<?php

namespace App\Services;

use App\Dtos\Affiliate;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class AffiliateRetrievalService
{
    /**
     * @param UploadedFile $file
     * @param $targetLat
     * @param $targetLon
     * @return Collection<int, Affiliate>
     */
    public function getNearbyAffiliates(
        UploadedFile $file,
        $targetLat,
        $targetLon
    ): Collection
    {
        $affiliates = $this->retrieveAffiliates($file);

        return collect($affiliates)
            ->filter(function ($affiliate) use ($targetLat, $targetLon) {
                $distance = DistanceCalculatorService::calculateDistance(
                    $targetLat,
                    $targetLon,
                    $affiliate->getLatitude(),
                    $affiliate->getLongitude()
                );

                return $distance <= 100;
            })
            ->sortBy(function (Affiliate $affiliate) {
                return $affiliate->getAffiliateId();
            });
    }

    /**
     * @param UploadedFile $file
     * @return Collection<int, Affiliate>
     */
    private function retrieveAffiliates(UploadedFile $file): Collection
    {
        $contents = file_get_contents($file->getRealPath());

        // Use preg_split to split regardless of line ending type
        $lines = preg_split('/\r\n|\r|\n/', $contents);

        return collect($lines)
            ->filter() // Remove empty lines
            ->map(function ($line) {
                $data = json_decode($line, true);

                return json_last_error() === JSON_ERROR_NONE ? new Affiliate(
                    latitude: $data['latitude'],
                    longitude: $data['longitude'],
                    affiliateId: $data['affiliate_id'],
                    name: $data['name'],
                ) : null;
            })
            ->filter();
    }
}
