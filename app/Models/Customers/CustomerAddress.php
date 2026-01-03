<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table= "customer_addresses";
    //  protected $table = 'customer_addresses';

    protected $fillable = [
        'customer_id',
        'type',
        'country',
        'city',
        'address',
        'postal_code',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_id');
    }

}
