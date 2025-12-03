<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VinManufacturer extends Model
{
    protected $fillable = [
        'wmi', 'name', 'country', 'website', 'is_active',
    ];
}
