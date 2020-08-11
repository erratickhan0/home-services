<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
class AuthController extends Controller
{
    public $successStatus = 200;
    public function register(Request $request)
    {
        $request['user_type_id']=1;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('HomeServices')-> accessToken;
        return response()->json(['success'=>$success], $this-> successStatus);

    }
    public function register_customer(Request $request)
    {
        $request['user_type_id']=2;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $customer=new Customer();
        $customer->first_name=$request['first_name'];
        $customer->last_name=$request['last_name'];
        $customer->save();

        $success['token'] =  $user->createToken('HomeServices')-> accessToken;
        return response()->json(['success'=>$success], $this-> successStatus);

    }
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = Auth::user();

            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
                'token' => $token->accessToken
            ]);
        }
        else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

}
