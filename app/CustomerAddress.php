<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table='customer_addresses';
    protected $fillable=['customer_id','house_num','street','area','nearest_place','longitude','longitude'];
}
