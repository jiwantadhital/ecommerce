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
        <form action="{{route('customer.login')}}" method="post">
          @csrf
          <div class="register-top-grid">
          <div class="  register-bottom-grid">
            <h3>LOGIN INFORMATION</h3>
            <div class="mation">
              <span>Email<label>*</label></span>
              <input type="text" name="email">
              @include('frontend.includes.single_validation', ['name' => 'email'])
              <span>Password<label>*</label></span>
              <input type="text" name="password">
              @include('frontend.includes.single_validation', ['name' => 'password'])
            </div>
          </div>
          <div class="clearfix"> </div>
          <div class="register-but">

            <input type="submit" value="submit">
            <div class="clearfix"> </div>
          </div>
          </div>
        </form>
      </div>
    </div>
    @include('frontend.includes.siderbar')
    <div class="clearfix"> </div>
  </div>
  <!---->
  @include('frontend.includes.footer')
@endsection
