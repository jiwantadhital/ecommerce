<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    function category(){
        return Category::where('status',1)->get();
    }

    function product(){
        return Product::where('status',1)->get();
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = User::where('id',auth()->user()->id)->first();
            $success['token'] =  $user->createToken('TokenName')-> accessToken;
            return $success;
//            $success['user'] = $user;
//            $response = [
//                'success' => "true",
//                'status' => $this->successStatus,
//                'data'  => $success
//            ];
//            return response()->json($response, $this-> successStatus);
        } else {
            return "Failed";
//            $response = [
//                'success' => "false",
//                'status' => $this->errorStatus
//            ];
//            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
