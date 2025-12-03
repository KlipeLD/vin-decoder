<?php

namespace App\Services;

class VinManufacturerCatalog
{
    public function __construct(
        private readonly array $map = []
    ) {}

    public static function fromConfig(): self
    {
        return new self(
            config('vin.wmi_manufacturers', [])
        );
    }

    public function findByWmi(string $wmi): ?array
    {
        $wmi = strtoupper($wmi);

        return $this->map[$wmi] ?? null;
    }
}