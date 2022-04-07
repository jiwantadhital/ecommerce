@extends('frontend.layouts.master')
@section('content')
  @include('frontend.includes.header')
  <div class="container">
    <div class="shoes-grid">
      <div class="wrap-in">
        <div class="wmuSlider example1 slide-grid">
          <div class="wmuSliderWrapper">
            @foreach($data['sliders'] as $slider)
              @php ($image = $slider->images->first())
            <article style="position: absolute; width: 100%; opacity: 0;">
              <div class="banner-matter">
                <div class="col-md-5 banner-bag">
                @if ($image !== null)
                    <img class="img-responsive" src="{{asset('images/product/1200_600_' . $image->image_name)}}" alt=" " />
                @endif
                  {{--<img class="img-responsive" src="{{asset('images/product/1200_600_' . $image[0]->name)}}" alt=" " />--}}

                </div>
                <div class="col-md-7 banner-off">
                  <h2>{{$slider->title}}</h2>
                  <label> <b>{{$slider->category->name}}</b></label>
                  <p>{{$slider->short_description}}</p>
                  <span class="on-get">GET NOW</span>
                </div>
                <div class="clearfix"> </div>
              </div>
            </article>
            @endforeach
          </div>
          <ul class="wmuSliderPagination">
            <li><a href="#" class="">0</a></li>
            <li><a href="#" class="">1</a></li>
            <li><a href="#" class="">2</a></li>
          </ul>
          <script src="{{asset('assets/frontend/js/jquery.wmuSlider.js')}}"></script>
          <script>
            $('.example1').wmuSlider();
          </script>
        </div>
      </div>
      <!---->
      <div class="shoes-grid-left">
        <a href="single.html">
          <div class="col-md-6 con-sed-grid">

            <div class=" elit-grid">

              <h4>consectetur  elit</h4>
              <label>FOR ALL PURCHASE VALUE</label>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p>
              <span class="on-get">GET NOW</span>
            </div>
            <img class="img-responsive shoe-left" src="images/sh.jpg" alt=" " />

            <div class="clearfix"> </div>

          </div>
        </a>
        <a href="single.html">
          <div class="col-md-6 con-sed-grid sed-left-top">
            <div class=" elit-grid">
              <h4>consectetur  elit</h4>
              <label>FOR ALL PURCHASE VALUE</label>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p>
              <span class="on-get">GET NOW</span>
            </div>
            <img class="img-responsive shoe-left" src="images/wa.jpg" alt=" " />

            <div class="clearfix"> </div>
          </div>
        </a>
      </div>
      <div class="products">
        <h5 class="latest-product">LATEST PRODUCTS</h5>
        <a class="view-all" href="product.html">VIEW ALL<span> </span></a>
      </div>
      <div class="product-left">
        @foreach($data['latest_products'] as $key => $latest_product)
          @php ($image = $slider->images->first())
        <div class="col-md-4 chain-grid @if($key == 2)  grid-top-chain @endif">
          <a href="single.html">
            <img class="img-responsive chain" src="{{asset('images/product/200_100_' . $image->image_name)}}" alt=" " /></a>
          @if ($latest_product->flash_product == 1)

            <span class="star"> </span>

          @endif
          <div class="grid-chain-bottom">
            <h6><a href="single.html">{{$latest_product->title}}</a></h6>
            <div class="star-price">
              <div class="dolor-grid">
                <span class="actual">{{$latest_product->price-$latest_product->discount}}</span>
                <span class="reducedfrom">{{$latest_product->price}}</span>
                <span class="rating">
									        <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
									        <label for="rating-input-1-5" class="rating-star1"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
									        <label for="rating-input-1-4" class="rating-star1"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
									        <label for="rating-input-1-3" class="rating-star"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
									        <label for="rating-input-1-2" class="rating-star"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
									        <label for="rating-input-1-1" class="rating-star"> </label>
							    	   </span>
              </div>
              <a class="now-get get-cart" href="#">ADD TO CART</a>
              <div class="clearfix"> </div>
            </div>
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

@section('js')
  <script>
    $(document).ready(function() {
      $('#lang_select').change(function() {
        var value = $(this).val();
        window.location = value;
      })
    })
  </script>
@endsection