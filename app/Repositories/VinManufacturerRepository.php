<?php

namespace App\Repositories;

use App\Models\VinManufacturer;

class VinManufacturerRepository
{
    public function findByWmi(string $wmi): ?VinManufacturer
    {
        return VinManufacturer::query()
            ->where('wmi', strtoupper($wmi))
            ->where('is_active', true)
            ->first();
    }
}