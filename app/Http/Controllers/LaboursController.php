<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\CreateLabourRequest;
use App\Labour;
use App\LabourReview;
use App\LabourTiming;
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
           $labour->category_id=$request['category_id'];
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
        $data=$this->model->with('cities')->with('cats')->with('timings')->paginate(10);
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
    public function labourReviewsApi(Request $request)
    {
        if(isset($request['customer_id']) && isset($request['labour_id']) && isset($request['message']) && isset($request['rating']))
        {

            $review=new LabourReview();
            $review->customer_id=$request['customer_id'];
            $review->labour_id=$request['labour_id'];
            $review->message=$request['message'];
            $review->rating=$request['rating'];
            $review->name=isset($request['name'])?$request['name']:'';
            $review->email=isset($request['email'])?$request['email']:'';
            $review->subject=isset($request['subject'])?$request['subject']:'';
            $review->save();
            return response()->json($review, Response::HTTP_OK);
        }
        else
        {
            return response()->json('Some Params are missing!', 500);
        }

    }
    public function addLabourTimings(Request $request)
    {
      if(isset($request['labour_id']) && isset($request['time_slot_id']))
      {
          $timings=LabourTiming::where('labour_id','=',$request['labour_id'])->where('time_slot_id','=',$request['time_slot_id'])->first();
          if(!$timings)
          {
              $labourtimings=new LabourTiming();
              $labourtimings->labour_id=$request['labour_id'];
              $labourtimings->time_slot_id=$request['time_slot_id'];
              $labourtimings->start_time=1;
              $labourtimings->end_time=1;
              $labourtimings->save();
              return 'timings save';
          }
          else
          {
              return 'already added';
          }

      }

    }

}
