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
        <form action="{{route('frontend.customer.store')}}" method="post">
          @csrf
          <div class="register-top-grid">
            <h3>PERSONAL INFORMATION</h3>
            <div class="mation">
              <span>First Name<label>*</label></span>
              <input type="text" name="fname" value="{{old('fname')}}">
              @include('frontend.includes.single_validation', ['name' => 'fname'])
              <span>Middle Name<label>*</label></span>
              <input type="text" name="mname">
              <span>Last Name<label>*</label></span>
              <input type="text" name="lname">
              @include('frontend.includes.single_validation', ['name' => 'lname'])

              <span>Email Address<label>*</label></span>
              <input type="email" name="email" >
              <span>Permanent Address<label>*</label></span>
              <input type="text" name="perm_address">
              @include('frontend.includes.single_validation', ['name' => 'perm_address'])

              <span>Phone</span>
              <input type="number" name="phone">
              <span>Mobile<label>*</label></span>
              <input type="number" name="mobile">
              @include('frontend.includes.single_validation', ['name' => 'mobile'])

              <span>Gender<label>*</label></span>
              <select name="gender_id" id="" style="width: 75%;height: 20px;">
                <option value="">Select gender</option>
                @foreach($data['genders'] as $gender)
                  <option value="{{$gender->id}}">{{$gender->name}}</option>
                  @endforeach
              </select>
              @include('frontend.includes.single_validation', ['name' => 'gender_id'])

              <span>Temporary Address</span>
              <input type="text" name="temp_address">
              <span>DOB<label>*</label></span>
              <input type="date" name="dob">
              @include('frontend.includes.single_validation', ['name' => 'dob'])
              <span>Image</span>
              <input type="file" name="image">
            </div>
            <div class="clearfix"> </div>
            <a class="news-letter" href="#">
              <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up</label>
            </a>
          </div>
          <div class="  register-bottom-grid">
            <h3>LOGIN INFORMATION</h3>
            <div class="mation">
              <span>Password<label>*</label></span>
              <input type="text" name="password">
              @include('frontend.includes.single_validation', ['name' => 'password'])

              <span>Confirm Password<label>*</label></span>
              <input type="text" name="password_confirmation">
              @include('frontend.includes.single_validation', ['name' => 'password_confirmation'])

            </div>
          </div>
        <div class="clearfix"> </div>
        <div class="register-but">

            <input type="submit" value="submit">
            <div class="clearfix"> </div>
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