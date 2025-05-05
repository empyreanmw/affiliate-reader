<?php

namespace App\Dtos;


use Illuminate\Support\Collection;

class Affiliate
{
    public function __construct(
        public string $latitude,
        public string $longitude,
        public int $affiliateId,
        public string $name,
    ) {}

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAffiliateId(): string
    {
        return $this->affiliateId;
    }

    public function toCollection(): Collection
    {
        return collect([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'affiliate_id' => $this->affiliateId,
            'name' => $this->name
        ]);
    }

    public function toArray(): array
    {
        return $this->toCollection()->toArray();
    }
}
