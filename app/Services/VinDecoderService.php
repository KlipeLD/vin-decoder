<?php

namespace App\Services;

class VinDecoderService
{
    public function __construct(
        private readonly VinManufacturerCatalog $catalog
    ) {}

    public function decode(string $vin): array
    {
        $vin = strtoupper(trim($vin));

        return [
            'vin'          => $vin,
            'wmi'          => $this->getWmi($vin),
            'vds'          => substr($vin, 3, 6), // Vehicle Descriptor Section
            'vis'          => substr($vin, 9, 8), // Vehicle Identifier Section
            'region'       => $this->getRegion($vin),
            'manufacturer' => $this->getManufacturer($vin),
            'model_year'   => $this->getModelYear($vin),
            'serial'       => substr($vin, 11, 6),
        ];
    }

    private function getWmi(string $vin): string
    {
        return substr($vin, 0, 3);
    }

    private function getRegion(string $vin): ?string
    {
        $first = $vin[0] ?? null;
        if (!$first) {
            return null;
        }

        $map = [
            'A' => 'Africa',
            'B' => 'Africa',
            'C' => 'Africa',
            'J' => 'Asia',
            'K' => 'Asia',
            'L' => 'Asia',
            'M' => 'Asia',
            'S' => 'Europe',
            'T' => 'Europe',
            'U' => 'Europe',
            'V' => 'Europe',
            'W' => 'Europe',
            'X' => 'Europe',
            'Y' => 'Europe',
            'Z' => 'Europe',
            '1' => 'North America',
            '2' => 'North America',
            '3' => 'North America',
            '4' => 'North America',
            '5' => 'North America',
            '6' => 'Oceania',
            '7' => 'Oceania',
            '8' => 'South America',
            '9' => 'South America',
        ];

        return $map[$first] ?? null;
    }

    private function getManufacturer(string $vin): ?string
    {
        $wmi = substr($vin, 0, 3);

        $manufacturer = $this->catalog->findByWmi($wmi);

        return $manufacturer['name'] ?? null;
    }

    private function getModelYear(string $vin): ?int
    {
        $yearCode = $vin[9] ?? null;
        if (!$yearCode) {
            return null;
        }

        $map = [
            'A' => 2010,
            'B' => 2011,
            'C' => 2012,
            'D' => 2013,
            'E' => 2014,
            'F' => 2015,
            'G' => 2016,
            'H' => 2017,
            'J' => 2018,
            'K' => 2019,
            'L' => 2020,
            'M' => 2021,
            'N' => 2022,
            'P' => 2023,
            'R' => 2024,
            'S' => 2025,
            'T' => 2026,
            'V' => 2027,
            'W' => 2028,
            'X' => 2029,
            'Y' => 2030,
            '1' => 2001,
            '2' => 2002,
            '3' => 2003,
            '4' => 2004,
            '5' => 2005,
            '6' => 2006,
            '7' => 2007,
            '8' => 2008,
            '9' => 2009,
        ];

        return $map[$yearCode] ?? null;
    }
}