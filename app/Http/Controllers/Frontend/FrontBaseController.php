<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class FrontBaseController extends Controller
{
    protected  function  __loadDataToView($viewPath){
        view()->composer($viewPath, function ($view) {
            $categories = Category::where('status',1)->orderby('rank')->get();
            $view->with('title', $this->title);
            $view->with('menu', $categories);
            $view->with('cart',Cart::content());
            $view->with('cart_count',Cart::count());

        });
        return $viewPath;
    }
}
