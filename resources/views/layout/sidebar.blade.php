<div class="container-fluid" id="main">
  <div class="row row-offcanvas row-offcanvas-left">
    <div class="col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation">
      <ul class="nav flex-column pl-1">
        <li class="nav-item"><a class="nav-link" href="{{ url('/index') }}">Contacts</a></li>
        <li class="nav-item">
          <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Statistics by Department ▾</a>
          <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
            @foreach($departments as $department)
              <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[$department->id]) }}">{{$department->name}}</a></li>
            @endforeach
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/finished') }}">List of Finished Requests</a></li>
      </ul>
    </div>
