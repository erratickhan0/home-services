<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $table='labours';
    protected $fillable = ['cnic','phone','registeration_num','city_id','country_id','user_id','address','vehicle_id'];

    public function timings()
    {
        return $this->hasMany('App\LabourTiming', 'labour_id');
    }
    public function locations()
    {
        return $this->hasMany('App\LabourLocation', 'labour_id');
    }
    public function cities()
    {
        return $this->belongsTo('App\Cities', 'city_id');
    }
}
