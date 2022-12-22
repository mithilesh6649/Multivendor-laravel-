<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;

    protected $guard = 'admin';

    protected $fillable = ['email', 'type', 'name', 'mobile', 'image'];

    public function vendorPersonal()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id');
    }

    public function vendorBusiness()
    {
        return $this->belongsTo('App\Models\VendorsBusinessDetail', 'vendor_id', 'id');
    }

    public function vendorBank()
    {
        return $this->belongsTo('App\Models\VendorsBankDetail', 'vendor_id', 'id');
    }

}
