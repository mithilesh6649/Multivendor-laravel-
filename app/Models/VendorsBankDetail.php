<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorsBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
            'account_holder_name',
            'bank_name',
            'account_number',
            'bank_ifsc_code'
    ];
}
