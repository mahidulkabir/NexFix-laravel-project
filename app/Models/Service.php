<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    // for vendor service management by admin 
    public function vendors()
{
    return $this->belongsToMany(Vendor::class, 'vendor_services')
                ->withPivot('price', 'active')
                ->withTimestamps();
}

}
