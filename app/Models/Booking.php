<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function customer()
{
    return $this->belongsTo(User::class, 'customer_id');
}

public function vendorService()
{
    return $this->belongsTo(VendorService::class);
}

public function payment()
{
    return $this->hasOne(Payment::class);
}

public function review()
{
    return $this->hasOne(Review::class);
}
}
