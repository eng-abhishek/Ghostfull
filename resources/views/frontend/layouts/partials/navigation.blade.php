<header>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xxl-4 col-lg-4 col-6">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" title="About">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" title="Pricing">Pricing</a>
                    </li>
                </ul>
            </div>
            <div class="col-xxl-4 col-lg-4 col-6 order-lg-3">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" title="Upload"><label for="toggler" class="strikethrough">Upload</label></a>
                    </li>

                    @if(!empty(Auth::User()->id))

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('account.profile')}}" title="Profile">
                        Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Login">logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>


                  @else

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" title="Login">Login</a>
                </li>
                @endif                   

                
            </ul>
        </div>
        <div class="col-xxl-4 col-lg-4 text-center order-lg-2">
            <a href="javascript:void(0)" title="logo"><img src="{{asset('assets/frontend/images/logo.png')}}" class="logo" alt="logo"></a>
        </div>
    </div>
</div>
</header>