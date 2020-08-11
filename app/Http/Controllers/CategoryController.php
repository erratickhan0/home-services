<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    const PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $cat)
    {

        $this->model=$cat;
    }
    public function index(Request $request)
    {

        $categories=$this->model->paginate(10);




        if($categories) {
            return response()->json($categories);
        }

        return response()->json(['message' => 'Categories not found!'], 404);

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



        $data=[];

        if(isset($request['id']))
        {
            $cat=Category::find($request['id']);
            $cat->short_desc=isset($request['short_desc'])?$request['short_desc']:'';
            $cat->long_desc=isset($request['long_desc'])?$request['long_desc']:'';
            $cat->category_name=isset($request['category_name'])?$request['category_name']:'';
            $cat->save();
            return response()->json($cat, Response::HTTP_OK);
        }
        $data=$request->all();

       if(!isset($request['parent_id']))
       {
           $data['parent_id']=0;

       }
        $data['vendor_id']=0;

        $cat = Category::create($data);
        return response()->json($cat, Response::HTTP_OK);

        //
    }
    public function getAll()
    {
        $categories=$this->model->get();




        if($categories) {
            return response()->json($categories);
        }

        return response()->json(['message' => 'Categories not found!'], 404);

    }
    public function subCategoryCreate(Request $request)
    {
       if(isset($request['category_id']))
       {
           $cat=new Category();
           $cat->parent_id=$request['category_id'];
           $cat->vendor_id=0;
           $cat->short_desc=isset($request['short_desc'])?$request['short_desc']:'';
           $cat->long_desc=isset($request['long_desc'])?$request['long_desc']:'';
           $cat->category_name=isset($request['category_name'])?$request['category_name']:'';
           $cat->save();
           return response()->json($cat, Response::HTTP_OK);

       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       echo 'zee';
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
}
