<nav class="navbar navbar-fixed-top navbar-toggleable-sm navbar-inverse bg-primary mb-3">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="flex-row d-flex">
    <a class="navbar-brand mb-1" href="{{ url('/') }}">PrintIT</a>
    <button type="button" class="hidden-md-up navbar-toggler" data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
  </div>
  <div class="navbar-collapse collapse" id="collapsingNavbar">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home<span class="sr-only"></span></a>
      </li>
        @if(!Auth::guest())
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/list') }}">Request Dashboard<span class="sr-only"></span></a>
            </li>
            @if(Auth::user()->admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.manageblock') }}">Manage User Clearence<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.managerole') }}">Manage User Roles<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Manage Comments<span class="sr-only"></span></a>
                </li>
            @endif
        @endif
    </ul>
  </div>


<ul class="navbar-nav ml-auto">

      @if(Auth::guest())

      <li class="nav-item">
      <a class="nav-link" href="{{ url('/login') }}">Login<span class="sr-only">Login</span></a>

      <li class="nav-item">
      <a class="nav-link" href="{{ url('/register') }}">Register<span class="sr-only">Register</span></a>
      </ul>

      @else (Auth::check())

  <img src ="/img/profile_photo{{ Auth::user()->profile_photo }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">

  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }}
  <span class="caret"></span></button>

  <ul class="dropdown-menu">
    <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
  </ul>

        @endif

</nav>
