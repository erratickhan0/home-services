<?php

namespace App\Http\Controllers;

use App\CustomerAddress;
use Illuminate\Http\Request;
use App\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function show(Request $request, $userId)
    {
        $user = User::find($userId);

        if($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'User not found!'], 404);
    }
    public function createCustAddressApi(Request $request)
    {
        if(isset($request['customer_id']) && isset($request['street']) && isset($request['area']) && isset($request['longitude']) && isset($request['latitude'])   )
        {
            $input = $request->all();

            $cust_addr = CustomerAddress::create($input);


            return response()->json($cust_addr, Response::HTTP_OK);

        }
        else
        {
            $rt='some params are missing';
            return response()->json($rt, 400);
        }
    }
}
