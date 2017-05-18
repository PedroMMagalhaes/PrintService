<nav class="navbar navbar-fixed-top navbar-toggleable-sm navbar-inverse bg-primary mb-3">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="flex-row d-flex">
    <a class="navbar-brand mb-1" href="#">PrintIT</a>
    <button type="button" class="hidden-md-up navbar-toggler" data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
  </div>
  <div class="navbar-collapse collapse" id="collapsingNavbar">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home<span class="sr-only">Home</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Print Request<span class="sr-only">Print Request</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Create Request<span class="sr-only">Create Request</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Dashboard<span class="sr-only">Dashboard</span></a>
      </li>
    </ul>

<ul class="navbar-nav ml-auto">
      @if(Auth::guest())

      <li class="nav-item">
      <a class="nav-link" href="{{ url('/login') }}">Login<span class="sr-only">Login</span></a>

      <li class="nav-item">
      <a class="nav-link" href="{{ url('/register') }}">Register<span class="sr-only">Register</span></a>
      @else (Auth::check())

        <li class="nav-item">
        <a class="nav-link" href="{{ url('/logout') }}">Logout<span class="sr-only">Register</span></a>

        <li class="nav-item">
        <p class="navbar-text ml-auto">{{ Auth::user()->name }}</p>



        @endif

      </li>
    </ul>



  </div>


</nav>
