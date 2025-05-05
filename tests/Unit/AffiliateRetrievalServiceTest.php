<?php

namespace Tests\Unit;

use App\Dtos\Affiliate;
use App\Services\AffiliateRetrievalService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Tests\TestCase;

class AffiliateRetrievalServiceTest extends TestCase
{
    /** @test */
    public function it_returns_affiliates_within_100_km_sorted_by_id()
    {
        $content = <<<TXT
            {"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}
            {"latitude": "53.339428", "affiliate_id": 1, "name": "Lance Keith", "longitude": "-6.257664"}
            TXT;

        $file = UploadedFile::fake()->createWithContent('affiliates.txt', $content);
        $service = new AffiliateRetrievalService();

        $results = $service->getNearbyAffiliates($file, 53.3340285, -6.2535495);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertCount(2, $results);
        $this->assertInstanceOf(Affiliate::class, $results->first());
        $this->assertEquals(1, $results->first()->getAffiliateId()); // sorted by ID
    }

    /** @test */
    public function it_ignores_invalid_json_lines()
    {
        $content = <<<TXT
            invalid json
            {"latitude": "53.0", "affiliate_id": 99, "name": "Valid", "longitude": "-6.0"}
            TXT;

        $file = UploadedFile::fake()->createWithContent('bad.txt', $content);
        $service = new AffiliateRetrievalService();

        $results = $service->getNearbyAffiliates($file, 53.3340285, -6.2535495);

        $this->assertCount(1, $results);
        $this->assertEquals(99, $results->first()->getAffiliateId());
    }
}
