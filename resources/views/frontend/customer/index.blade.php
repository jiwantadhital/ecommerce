@extends('frontend.layouts.master')
@section('css')
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6065cbdf4d1bac0012adf42e&product=inline-share-buttons" async="async"></script>  @endsection
@section('content')

  @include('frontend.includes.header')
  <!---->
  <!-- start content -->
  <div class="container">
    <div class=" ">
      @if(Session::has('success_message'))
        <p class="alert alert-success">{!!  Session::get('success_message') !!}</p>
      @endif

      @if(Session::has('error_message'))
        <p class="alert alert-danger">{{ Session::get('error_message') }}</p>
      @endif
      <div class="register">

          <div class="register-top-grid">
          <div class="  register-bottom-grid">
            <form action="{{route('customer.logout')}}" method="post">
              @csrf
              <input type="submit" value="Logout"/>
            </form>
            <h3>Dashboard INFORMATION</h3>

          </div>



      </div>
    </div>
    @include('frontend.includes.siderbar')
    <div class="clearfix"> </div>
  </div>
  <!---->
  @include('frontend.includes.footer')
@endsection