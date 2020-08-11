<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table='categories';
    protected $fillable = ['category_name','short_desc','long_desc','parent_id','vendor_id'];
    //
}
