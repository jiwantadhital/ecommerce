@extends('frontend.layouts.master')

@section('content')

  @include('frontend.includes.header')
<!---->
<!-- start content -->
<div class="container">

  <div class="women-product">
    <div class=" w_content">
      <div class="women">
        <a href="#"><h4>{{$data['subcategory']->name}} - <span>{{$data['subcategory']->products->count()}} items</span> </h4></a>
        <ul class="w_nav">
          <li>Sort : </li>
          <li><a class="active" href="#">popular</a></li> |
          <li><a href="#">new </a></li> |
          <li><a href="#">discount</a></li> |
          <li><a href="#">price: Low High </a></li>
          <div class="clearfix"> </div>
        </ul>
        <div class="clearfix"> </div>
      </div>
    </div>
    <!-- grids_of_4 -->
    <div class="grid-product">
      @foreach($data['subcategory']->products as $product)
        @php ($image = $product->images->first())
      <div class="  product-grid">
        <div class="content_box">
          <a href="{{route('frontend.product',$product->slug)}}">
            <div class="left-grid-view grid-view-left">
              @if($image)
                <img src="{{asset('images/product/200_100_' . $image->image_name)}}" class="img-responsive watch-right" alt=""/>
              @else

                <img src="" class="img-responsive watch-right" alt=""/>

              @endif
                <div class="mask">
                  <div class="info">Quick View</div>
                </div>
            </div>
          </a>

        <h4><a href="{{route('frontend.product',$product->slug)}}">{{$product->title}}</a></h4>
        <p>{{$product->short_description}}</p>
        Rs.{{$product->price-$product->discount}}
      </div>
    </div>
    @endforeach

<div class="clearfix"> </div>
</div>
</div>
  @include('frontend.includes.siderbar')
<div class="clearfix"> </div>
</div>
<!---->
  @include('frontend.includes.footer')
@endsection