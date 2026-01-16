<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOwner extends Model
{
    protected $fillable = [
        'name',
        'aadhar_number',
        'mobile_number',
        'mobile_name',
        'work',
        'imei_number',
        'date',
        'device_status',
        'document',
    ];
}
