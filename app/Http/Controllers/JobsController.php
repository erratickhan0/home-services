<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $model;
    public function __construct(Job $job)
    {
            $this->model=$job;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function findByAllAdmin()
    {

        $data=[];
        $data=$this->model->with('status')->with('cats')->with('customer')->with('labour')->with('cust_address')->paginate(10);

        return $data;

    }
    public function createJobApi(Request $request)
    {
        if(isset($request['customer_id']) && isset($request['labour_id']) && isset($request['category_id']) && isset($request['cust_address_id'])  )
        {
            $input = $request->all();

            $job = Job::create($input);

            $request['job_id']=$job->id;
            $data['job_id']=$request['job_id'];
            $job_st = JobStatus::create($data);
            return response()->json($job, Response::HTTP_OK);

        }
        else
        {
            $rt='some params are missing';
            return response()->json($rt, 400);
        }

    }
    public function jobStatusChangeByAdmin(Request $request)
    {
        if(isset($request['id']) && isset($request['status']))
        {
            $job=JobStatus::where('job_id',$request['id'])->first();
            if($job)
            {
                $job->rejected=false;
                $job->accepted=false;
                $job->assigned=false;
                $job->in_progress=false;
                $job->done=false;

                if($request['status']=='rejected')
                {
                    $job->rejected=true;
                    $job->rejected_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='accepted')
                {
                    $job->accepted=true;
                    $job->accepted_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='assigned')
                {
                    $job->assigned=true;
                    $job->assigned_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='in_progress')
                {
                    $job->in_progress=true;
                    $job->in_progress_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='done')
                {
                    $job->done=true;
                    $job->done_at=date('Y-m-d H:i:s');
                    $job->save();
                }
            }
            return 'status updated';
        }

    }
    public function jobStatusChangeByApi(Request $request)
    {
        if(isset($request['id']) && isset($request['status']))
        {
            $job=JobStatus::where('job_id',$request['id'])->first();
            if($job)
            {
                $job->rejected=false;
                $job->accepted=false;
                $job->assigned=false;
                $job->in_progress=false;
                $job->done=false;

                if($request['status']=='rejected')
                {
                    $job->rejected=true;
                    $job->rejected_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='accepted')
                {
                    $job->accepted=true;
                    $job->accepted_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='assigned')
                {
                    $job->assigned=true;
                    $job->assigned_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='in_progress')
                {
                    $job->in_progress=true;
                    $job->in_progress_at=date('Y-m-d H:i:s');
                    $job->save();
                }
                if($request['status']=='done')
                {
                    $job->done=true;
                    $job->done_at=date('Y-m-d H:i:s');
                    $job->save();
                }
            }
            return 'status updated';
        }

    }
}
