@extends('frontend.layouts.master')
@section('css')
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6065cbdf4d1bac0012adf42e&product=inline-share-buttons" async="async"></script>  @endsection
@section('content')

  @include('frontend.includes.header')
  <!---->
  <!-- start content -->
  <div class="container">
    <form action="{{route('frontend.order')}}" method="post">
      @csrf
    <div class=" single_top">
      <h1>List of cart Item</h1>
      <div class="single_grid">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Attribute</th>
                <th>Total(Rs).</th>
              </tr>
            </thead>
          <tbody>
          @forelse($cart as $index => $c)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$c->name}}</td>
              <td>{{$c->price}}</td>
              <td>{{$c->qty}}</td>
              <td>
                <ul type="square">
                  @foreach($c->options as $attribute)
                    <li>{{$attribute}}</li>
                    @endforeach
                </ul>
              </td>
              <td>{{$c->qty * $c->price}}</td>
            </tr>
            @empty

              <tr>
                <td colspan="6">Item not added into cart</td>

              </tr>
            @endforelse
          <tr>
            <td colspan="5">Sub Total</td>
            <td>{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</td>
          </tr>
          <tr>
            <td colspan="5">Tax</td>
            <td>{{\Gloudemans\Shoppingcart\Facades\Cart::tax()}}</td>
          </tr>
          <tr>
            <td colspan="5">Grand Total</td>
            <td>{{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <div style="">
        <label for="shipping_cost">Shipping Cost</label>
        <select name="shipping_cost" id="shipping_cost">
          <option value="0">Inside Ringroad-Free</option>
          <option value="50">Outside Ringroad-50</option>
          <option value="150">Outside Kathmandu-150</option>
        </select>
      </div>
      <div style="">
        <label for="shipping_cost">Payment Method</label>
        <select name="payment_method" id="payment_method">
          <option value="cod">Cash in Delivery</option>
          <option value="paypal">Paypal</option>
          <option value="esewa">Esewa</option>
        </select>
      </div>
      <div style="">
        <button style="border: 1px solid green;padding: 10px;">Make Order</button>
      </div>
    </div>
    @include('frontend.includes.siderbar')
    <div class="clearfix"> </div>
    </form>
  </div>
  <!---->
  @include('frontend.includes.footer')
@endsection