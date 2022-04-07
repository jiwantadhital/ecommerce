<!--header-->
<div class="header">
  <div class="top-header">
    <div class="container">
      <div class="top-header-left">
        <ul class="support">
          <li><a href="#"><label> </label></a></li>
          <li><a href="#">{{ __('lang.support')}}</a></li>
        </ul>
        <ul class="support">
          <li class="van"><a href="#"><label> </label></a></li>
          <li><a href="#">{{ __('lang.free_shipping')}}</a></li>
        </ul>
        <div class="clearfix"> </div>
      </div>
      @php $locale = session()->get('locale'); @endphp
      <div class="top-header-right">
        <div class="down-top">
          <select class="in-drop" id="lang_select">
            <option value="lang/en" class="in-of" @if($locale == 'en') selected @endif>English</option>
            <option value="lang/jp" class="in-of" @if($locale == 'jp') selected @endif>Japanese</option>
            <option value="lang/np" class="in-of" @if($locale == 'np') selected @endif>नेपालि</option>
          </select>
        </div>
        <div class="down-top top-down">
          <select class="in-drop">

            <option value="Dollar" class="in-of">Dollar</option>
            <option value="Yen" class="in-of">Yen</option>
            <option value="Euro" class="in-of">Euro</option>
          </select>
        </div>
        <!---->
        <div class="clearfix"> </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
  <div class="bottom-header">
    <div class="container">
      <div class="header-bottom-left">
        <div class="logo">
          <a href="{{route('frontend.home')}}"><img src="images/logo.png" alt=" " /></a>
        </div>
        <div class="search">
          <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
          <input type="submit"  value="SEARCH">

        </div>
        <div class="clearfix"> </div>
      </div>
      <div class="header-bottom-right">
        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        @if(isset(\Illuminate\Support\Facades\Auth::guard('customer')->user()->name))
        <div class="account"><a href="#"><span> </span>Welcome {{\Illuminate\Support\Facades\Auth::guard('customer')->user()->name}}</a></div>
        @endif
          <ul class="login">
         @if(isset(\Illuminate\Support\Facades\Auth::guard('customer')->user()->name))
            <li><a href="{{route('customer.home')}}"><span> </span>Dashboard</a></li> |
            <li>
              <a  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                {{ __('Logout') }}
              </a>
            </li>
          @else
            <li><a href="{{route('customer.login')}}"><span> </span>LOGIN</a></li> |
            <li ><a href="{{route('frontend.customer.register')}}">SIGNUP</a></li>
            @endif

        </ul>
        <div class="cart"><a href="{{route('frontend.cart')}}"><span style="color:#fff"> {{$cart_count}}</span>CART</a></div>
        <div class="clearfix"> </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
<!---->
