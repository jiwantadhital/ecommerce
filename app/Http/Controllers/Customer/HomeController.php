<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function __construct()
    {
//        if(Auth::guard('customer')->user() === null){
//            return redirect('customer.login');
//        }
    }

    public function index(){
        $menu = Category::where('status',1)->orderby('rank')->get();
        $title = 'Customer Dashboard';
        $cart_count = \Gloudemans\Shoppingcart\Facades\Cart::count();
        return view('frontend.customer.index',compact('cart_count','menu','title'));

    }
}
