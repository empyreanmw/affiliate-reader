<?php

namespace App\Dtos;


use Illuminate\Support\Collection;

class Affiliate
{
    public function __construct(
        public ?string $latitude = null,
        public ?string $longitude = null,
        public ?int $affiliateId = null,
        public ?string $name = null,
    ) {}

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getAffiliateId(): ?string
    {
        return $this->affiliateId;
    }

    /**
     * @return Collection
     */
    public function toCollection(): Collection
    {
        return collect([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'affiliate_id' => $this->affiliateId,
            'name' => $this->name
        ]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->toCollection()->toArray();
    }
}
