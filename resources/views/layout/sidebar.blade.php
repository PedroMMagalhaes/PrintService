<div class="container-fluid" id="main">
  <div class="row row-offcanvas row-offcanvas-left">
    <div class="col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation">
      <ul class="nav flex-column pl-1">
        <li class="nav-item"><a class="nav-link" href="{{ url('/index') }}">Contacts</a></li>
        <li class="nav-item">
          <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Statistics by Department ▾</a>
          <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">

            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[1]) }}">Ciências Jurídicas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[2]) }}">Ciências da Linguagem</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[3]) }}">Engenharia do Ambiente</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[4]) }}">Engenharia Civil</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[5]) }}">Engenharia Eletrotécnica</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[6]) }}">Engenharia Informática</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[7]) }}">Engenharia Mecânica</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[8]) }}">Gestão e Economia</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[9]) }}">Matemática</a></li>
          </ul>
        </li>
      </ul>
    </div>



    
