<?php

namespace App\Http\Controllers;

use App\TimeSlot;
use Illuminate\Http\Request;

class TimeSlotsController extends Controller
{
    protected $model;
    public function __construct(TimeSlot $time)
    {

        $this->model=$time;
    }
    public function findTimeSlots()
    {

        $data=[];
        $data=$this->model->get();
        return $data;
    }
    //
}
