<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\CreateLabourRequest;
use App\Labour;
use Illuminate\Http\Request;
use function App\Helpers\paginator;
use Symfony\Component\HttpFoundation\Response;

class LaboursController extends Controller
{
    protected $model;
    public function __construct(Labour $labour)
    {

        $this->model=$labour;
    }
    public function findById($id)
    {
        $data = array();
        $query = $this->model->find($id);

        if($query!= NULL){
            $data = $query;
        }else {
            $data = null;
        }

        return $data;
    }
    public function store(CreateLabourRequest $request)
    {
       if(isset($request['id']))
       {
           $labour = Labour::find($request['id']);
           $labour->cnic=$request['cnic'];
           $labour->address=$request['address'];
           $labour->phone=$request['phone'];
           $labour->city_id=$request['city_id'];
           $labour->registeration_num=$request['registeration_num'];
           $labour->save();
           return response()->json($labour, Response::HTTP_OK);
       }

        $data=[];
        $data=$request->all();


        $data['user_id']=0;
        $data['country_id']=1;
        $data['vehicle_id']=0;
        $labour = Labour::create($data);
        return response()->json($labour, Response::HTTP_OK);
    }
    public function findByAll()
    {

        $data=[];
        $data=$this->model->get();

       return $data;
    }
    public function findByAllAdmin()
    {

        $data=[];
        $data=$this->model->with('cities')->paginate(10);
        return $data;
    }
    public function findLabourTimings($id)
    {

        $data=[];
        $data=$this->model->with('timings')->get();
        return $data;
    }
    public function findLabourLocations($id)
    {
        $data=[];
        $data=$this->model->with('locations')->get();
        return $data;

    }
    public function updateRecord($request, $id)
    {
        $data = $this->model->findOrFail($id);
        $data->fill($request)->save();
        return $data;
    }
    public function deleteRecord($id)
    {
        $data = $this->model->find($id);
        if ($data != null) {
            $data->delete();
        }
        return [];
    }

}
