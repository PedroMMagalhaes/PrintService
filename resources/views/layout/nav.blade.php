
<div class="container">

 <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-primary">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">PrintIT</a>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Página Inicial <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Utilizadores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Impressões</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link ml-auto" href="#">Login</a>
          </li>
        <!-- Nav com nome de utilizador e a sua verificaç\ao de autenticaçao-->
          </ul>
        @if (Auth::check())

            <p class="navbar-text ml-auto">{{ Auth::user()->name }}</p>

      @endif

    </nav>

  </div>
