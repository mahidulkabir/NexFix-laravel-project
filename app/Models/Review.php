<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function booking()
{
    return $this->belongsTo(Booking::class);
}

public function customer()
{
    return $this->belongsTo(User::class, 'customer_id');
}

public function vendor()
{
    return $this->belongsTo(Vendor::class);
}
}
