<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'billing_first_name',
        'billing_last_name',
        'billing_email',
        'billing_address',
        'billing_phone',
        'billing_country',
        'billing_state',
        'billing_city',
        'billing_zip',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_email',
        'shipping_address',
        'shipping_phone',
        'shipping_country',
        'shipping_state',
        'shipping_city',
        'shipping_zip',
        'payment_method',
        'total_amount',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
