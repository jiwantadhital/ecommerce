@extends('frontend.layouts.master')
@section('css')
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6065cbdf4d1bac0012adf42e&product=inline-share-buttons" async="async"></script>  @endsection
@section('content')

  @include('frontend.includes.header')
  <!---->
  <!-- start content -->
  <div class="container">

    <div class=" single_top">
      <div class="single_grid">
        <div class="grid images_3_of_2">
          <ul id="etalage">
            @foreach($data['product']->images as $image)
            <li>
              <a href="optionallink.html">
                <img class="etalage_thumb_image" src="{{asset('images/product/200_100_' . $image->image_name)}}" class="img-responsive" />
                <img class="etalage_source_image" src="{{asset('images/product/200_100_' . $image->image_name)}}" class="img-responsive" title="" />
              </a>
            </li>
            @endforeach

          </ul>
          <div class="clearfix"> </div>
        </div>
        <div class="desc1 span_3_of_2">
          @if(Session::has('success_message'))
            <p class="alert alert-success">{{ Session::get('success_message') }}</p>
          @endif

          @if(Session::has('error_message'))
            <p class="alert alert-danger">{{ Session::get('error_message') }}</p>
          @endif

          {{--form to add into cart--}}
          <form  novalidate action="{{route('frontend.cart.add')}}" method="post">
            @csrf
            <input type="hidden" name="product_name" value="{{$data['product']->title}}"/>
            <input type="hidden" name="price" value="{{$data['product']->price-$data['product']->discount}}"/>
            <input type="hidden" name="price" value="{{$data['product']->price-$data['product']->discount}}"/>
            <input type="hidden" name="id" value="{{$data['product']->id}}"/>

            <input type="hidden" name="product_slug" value="{{$data['product']->slug}}"/>

            <h4>{{$data['product']->title}}</h4>
          <div class="cart-b">
            <div class="left-n ">Rs. {{$data['product']->price-$data['product']->discount}}</div>
            <button type="submit" class="now-get get-cart-in" href="#">ADD TO CART</button>
            <div class="clearfix"></div>
          </div>
          <h6>{{$data['product']->stock}} items in stock</h6>
            <h6>Quantity <input type="number" name="quantity" max="{{$data['product']->stock}}" min="1" value="1"/></h6>
            @error('quantity')
            <span class="text text-danger">{{$message}}</span>
            @enderror
            <p>{{$data['product']->short_description}}</p>
          @foreach($data['product']->attributes as $attribute)
            @php($attArray = explode(',',$attribute->attribute_value))
            <div class="share">
              <h5>{{$attribute->attribute->name}}</h5>
              <select name="attribute[{{$attribute->attribute->name}}]" id="attribute" class="form-control">
                <option value="">select {{$attribute->attribute->name}}</option>
                @foreach($attArray as $attArr)
                  <option value="{{$attArr}}">{{$attArr}}</option>
                  @endforeach
              </select>
            </div>
          @endforeach
                <button type="submit" class="now-get get-cart-in" href="#">ADD TO CART</button>

                <div class="share">
            <h5>Share Product :</h5>
            <div class="sharethis-inline-share-buttons"></div>
          </div>

          </form>
        </div>
        <div class="clearfix"> </div>
      </div>
      <script type="text/javascript">
        $(window).load(function() {
          $("#flexiselDemo1").flexisel({
            visibleItems: 5,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
              portrait: {
                changePoint:480,
                visibleItems: 1
              },
              landscape: {
                changePoint:640,
                visibleItems: 2
              },
              tablet: {
                changePoint:768,
                visibleItems: 3
              }
            }
          });

        });
      </script>
      <script type="text/javascript" src="js/jquery.flexisel.js"></script>

      <div class="toogle">
        <h3 class="m_3">Product Specification</h3>
        <p class="m_text">{{$data['product']->specification}}</p>
      </div>
      <div class="toogle">
        <h3 class="m_3">Product Description</h3>
        <p class="m_text">{{$data['product']->description}}</p>
      </div>
    </div>
    @include('frontend.includes.siderbar')
    <div class="clearfix"> </div>
  </div>
  <!---->
  @include('frontend.includes.footer')
@endsection