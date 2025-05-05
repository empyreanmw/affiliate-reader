<?php

namespace Tests\Unit;

use App\Services\DistanceCalculatorService;
use PHPUnit\Framework\TestCase;

class DistanceCalculatorServiceTest extends TestCase
{
    /** @test */
    public function it_calculates_correct_distance_between_two_points()
    {
        $distance = DistanceCalculatorService::calculateDistance(
            53.3340285, -6.2535495, // Dublin
            52.986375, -6.043701    // Close to Dublin
        );

        $this->assertIsFloat($distance);
        $this->assertGreaterThan(0, $distance);
        $this->assertLessThan(100, $distance);
    }

    /** @test */
    public function it_returns_zero_distance_for_same_coordinates()
    {
        $distance = DistanceCalculatorService::calculateDistance(
            53.3340285, -6.2535495,
            53.3340285, -6.2535495
        );

        $this->assertEquals(0.0, $distance);
    }
}
