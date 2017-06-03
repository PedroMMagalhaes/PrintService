@extends ('layout.master')


@section('content')


@include('layout.flash')



<form method="POST" action="/login">

{{ csrf_field() }}

<!--  LOGIN -->

<div class="wrapper">
    @if(count($errors) > 0)
        @include('layout.errors')
    @endif
    @include('partials.flashmessages')
  <form class="form-signin">
    <h2 class="form-signin-heading">Please login</h2>
    <p>
    </p>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required="" autofocus="" />
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required=""/>
    <label class="checkbox">
      <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
    </label>
    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
    </a>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
  </form>
</div>

<!--  LOGIN -->

        @include('layout.errors')

@endsection
