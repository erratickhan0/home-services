<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $table='labours';
    protected $fillable = ['cnic','phone','registeration_num','city_id','country_id','user_id','address','vehicle_id','category_id'];

    public function timings()
    {
        return $this->belongsToMany('App\TimeSlot','labour_timings' ,'labour_id','time_slot_id');
    }
    public function locations()
    {
        return $this->hasMany('App\LabourLocation', 'labour_id');
    }
    public function cities()
    {
        return $this->belongsTo('App\Cities', 'city_id');
    }
    public function cats()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
