<?php

namespace App\Http\Controllers;

use App\Cities;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminIndex()
    {

        //
        return view('admin/home');
    }

    public function insertCities()
    {

        $file = public_path('Cities.csv');




        $customerArr = $this->csvToArray($file);



        if($customerArr)
        {
            foreach ($customerArr as $key => $val)
            {

                $cities=new Cities;
                $cities->name=$val['Location'];
                $cities->country_id=1;
                $cities->save();
             }

        }

    }
    public function csvToArray($filename = '', $delimiter = ',')
    {

        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;

    }
    public function getAllCities()
    {
        $cities=Cities::all();
        return $cities;
    }
}
