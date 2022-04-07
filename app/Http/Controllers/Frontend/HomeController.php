<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Requests\CartRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\Attribute;
use App\Models\Customer;
use App\Models\Gender;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class HomeController extends FrontBaseController
{
    protected $folder = 'frontend.home.';  //for view file
    protected $title;

    function  index(){
        $this->title = 'Home';
        $data = [];
        $data['latest_products'] = Product::where('status',1)->limit(3)->orderby('created_at','desc')->get();
        $data['sliders'] = Product::where('feature_product',1)->where('status',1)->limit(3)->orderby('created_at','desc')->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));
    }

    function subcategory($slug){

        $data = [];
        $data['subcategory'] = Subcategory::where('slug',$slug)->first();
        $this->title = $data['subcategory']->name;
        return view($this->__loadDataToView($this->folder . 'subcategory'),compact('data'));
    }

    function  product($slug){
        $data = [];
        $data['product'] = Product::where('slug',$slug)->first();
        $this->title = $data['product']->name;
        return view($this->__loadDataToView($this->folder . 'product'),compact('data'));

    }

    function  addToCart(CartRequest $request){
        $attribute = [];
        if ($request->input('attribute')){
            $attribute = $request->input('attribute');
        }
       if(Cart::add(
            $request->input('id'),
            $request->input('product_name'),
            $request->input('quantity'),
            $request->input('price'),
            1,
            $attribute

        )){
           $request->session()->flash('success_message', 'Item added into cart successfully');

       } else {
           $request->session()->flash('error_message', ' Failed to add item into cart');

       }
        return redirect()->route('frontend.product', ['slug' => $request->input('product_slug')]);

    }

    function  listCart(){
        $data = [];
        $this->title = 'Cart Listing Page';
        return view($this->__loadDataToView($this->folder . 'cart'),compact('data'));

    }

    function  registerCustomer(){
        $data = [];
        $data['genders'] = Gender::all();
        $this->title = 'Register customer';
        return view($this->__loadDataToView($this->folder . 'register_customer'),compact('data'));
    }

    function  storeCustomer(CustomerRequest $request){
        $customerData['name'] = $request->input('fname') . ' ' . $request->input('mname') . ' ' . $request->input('lname');
        $customerData['email'] = $request->input('email');
        $customerData['password'] = Hash::make($request->input('password'));
        $customerData['perm_address'] = $request->input('perm_address');
        $customerData['temp_address'] = $request->input('temp_address');
        $customerData['phone'] = $request->input('phone');
        $customerData['mobile'] = $request->input('mobile');
        $customerData['status'] = $request->input('0');
        $customerData['gender_id'] = $request->input('gender_id');
        $customerData['email_verification_code'] = uniqid();
        $customerData['dob'] = $request->input('dob');
        $customerData['email_verfication_code'] = uniqid();
        $customerData['photo'] = 'test.jpg';
       $customer =  Customer::create($customerData);
        if ($customer){
            //send verification email
            $link = '/customer/verify_email/' .  $customer->email_verification_code;
            $request->session()->flash('success_message', "Customer Created Successfully,   <a href='$link' target='_blank'>Click here</a> to activate account");
        } else {
            $request->session()->flash('error_message', 'Customer creation failed!!!');
        }
        return redirect()->route('frontend.customer.register');
    }

    function  verifyEmail($code){
        $customer = Customer::where('email_verification_code',$code)->first();
        if ($customer){
            $customer->email_verification_code = null;
            $customer->status = 1;
            $customer->update();
            request()->session()->flash('success_message',"Customer verification success");
            return redirect()->route('frontend.customer.login');

        } else {
            request()->session()->flash('error_message', 'Customer verification failed!!!');
            return redirect()->route('frontend.customer.register');

        }
    }

    function  checkout(){
        $data = [];
        $this->title = 'Cart Checkout Page';
        return view($this->__loadDataToView($this->folder . 'checkout'),compact('data'));

    }

    function  order(Request $request){
        if ($request->input('payment_method') == 'cod'){
            $orderData = [];
            $orderData['customer_id'] = Auth::guard('customer')->user()->id;
            $orderData['order_code'] = uniqid();
            $orderData['discount'] = 0;
            $a = str_replace(',','',Cart::priceTotal());
            $orderData['price'] = $a;
            $orderData['shipping_cost'] = $request->input('shipping_cost');
            $orderData['total_price'] = $orderData['price'] + $orderData['shipping_cost']-$orderData['discount'];
            $orderData['order_date'] = date('Y-m-d H:i:s');
            $orderData['order_status_id'] =2;

            if ($order = Order::create($orderData)){
                $orderDetailData['order_id'] = $order->id;
                foreach (Cart::content() as $cart){
                    $orderDetailData['product_id'] = $cart->id;
                    $orderDetailData['quantity'] = $cart->qty;
                    $orderDetailData['price'] = $cart->price;
                    $orderDetailData['total'] = $cart->qty * $cart->price ;
                    $orderDetail = OrderDetail::create($orderDetailData);
                    if ($orderDetailData){
                        $orderAttributeData['product_id'] = $cart->id;
                        $orderAttributeData['order_detail_id'] = $orderDetail->id;
                        foreach ($cart->options as $key => $value){
                            $orderAttributeData['attribute_id']  = Attribute::where('name',$key)->first()->id;
                            $orderAttributeData['value']  = $value;
                            OrderAttribute::create($orderAttributeData);
                        }
                    }
                }
            }
            Cart::destroy();
            request()->session()->flash('success_message',"Order Placed Successfully");
            return redirect()->route('frontend.cart');
        } else if($request->input('payment_method') == 'paypal') {
            //process to connect paypal api
            $data = [];
            $data['items'] = [];
            foreach(Cart::content() as $cart) {
                $options = '';
                foreach ($cart->options as $key => $value) {
                    $options .= $key.':'.$value.',';
                }
                $item = [
                    'name'  => $cart->name,
                    'price' => $cart->price,
                    'qty'   => $cart->qty,
                    'desc'  => $options,
                ];
                array_push($data['items'],$item);
            }
            $data['invoice_id'] = 1;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = Cart::subtotal();
//            dd($data);

            $provider = new PayPalClient;

            //$provider = new ExpressCheckout();

            $response = $provider->setExpressCheckout($data);

            $response = $provider->setExpressCheckout($data, true);
            dd($response);

            return redirect($response['paypal_link']);
        } else if($request->input('payment_method') == 'esewa') {
            //process to connect esewa api
        }

    }
}
