<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

     protected $table= "customer_profiles";

      public function address(){
        return $this->hasMany(CustomerAddress::class, "customer_id");
      }
      
      public function notes(){
        return $this->hasMany(CustomerNote::class, "customer_id");
      }

}
