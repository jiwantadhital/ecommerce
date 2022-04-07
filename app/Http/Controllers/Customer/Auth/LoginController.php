<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $menu = Category::where('status',1)->orderby('rank')->get();
        $title = 'Customer Login';
        $cart_count = \Gloudemans\Shoppingcart\Facades\Cart::count();
        return view('frontend.customer.login',compact('cart_count','menu','title'));
    }

    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:customers|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }

    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error_message','Login failed, please try again!');
    }

    public function login(Request $request)
    {
//        dd($request->all());
        $this->validator($request);

        if(Auth::guard('customer')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect()
                ->intended(route('customer.home'))
                ->with('success_message','You are Logged in as customer!');
        }

        //Authentication failed...
        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        request()->session()->invalidate();
        return redirect()
            ->route('customer.login')
            ->with('status','Customer has been logged out!');
    }


}
