<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}
// for vendor service management by admin 
public function services()
{
    return $this->belongsToMany(Service::class, 'vendor_services')
                ->withPivot('price', 'active')
                ->withTimestamps();
}

public function vendorServices()
{
    return $this->hasMany(VendorService::class);
}

public function bookings()
{
    return $this->hasManyThrough(Booking::class, VendorService::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}
}
