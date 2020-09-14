<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table='jobs';
    protected $fillable = ['category_id','customer_id','labour_id','cust_address_id','location'];
    public function status()
    {
        return $this->hasOne('App\JobStatus', 'job_id');
    }
    public function cats()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function labour()
    {
        return $this->belongsTo('App\Labour', 'labour_id');
    }
    public function cust_address()
    {
        return $this->belongsTo('App\CustomerAddress', 'cust_address_id');
    }
}
