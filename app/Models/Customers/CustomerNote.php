<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class CustomerNote extends Model
{
     protected $table= "customer_notes";
    //  protected $table = 'customer_notes';

    protected $fillable = [
        'customer_id',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_id');
    }

}
