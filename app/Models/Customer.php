<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'aadhar_number',
        'mobile_number',
        'mobile_name',
        'work',
        'imei_number',
        'invoice_bill',
        'date',
        'device_status',
    ];
}
