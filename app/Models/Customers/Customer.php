<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

     protected $table= "customer_profiles";
      protected $fillable = [
        'customer_name',
        'photos',
        'email',
        'gender',
        'date_of_birth',
        'phone',
        'password',
        'total_orders',
        'total_spent',
        'customer_type',
    ];

      public function address(){
        return $this->hasMany(CustomerAddress::class, "customer_id");
      }

      public function notes(){
        return $this->hasMany(CustomerNote::class, "customer_id");
      }

}
