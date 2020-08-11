<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $model;
    public function __construct(Category $cat)
    {

        $this->model=$cat;
    }

    public function getParentCategories(Request $request)
    {
        $categories=$this->model->where('parent_id','=',0)->get();
        if($categories) {
            return response()->json($categories);
        }

        return response()->json(['message' => 'Categories not found!'], 404);
    }
    public function getChildrenCategories($parent)
    {


        $categories=$this->model->where('parent_id','=',$parent)->get();
        if($categories) {
            return response()->json($categories);
        }

        return response()->json(['message' => 'Categories not found!'], 404);
    }
    //
}
