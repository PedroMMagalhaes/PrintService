<div class="container-fluid" id="main">
  <div class="row row-offcanvas row-offcanvas-left">
    <div class="col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation">
      <ul class="nav flex-column pl-1">
        @if(!Auth::guest())
          <li class="nav-item"><a class="nav-link" href="{{ url('/list') }}">Request Dashboard</a></li>
          @if(Auth::user()->admin)
            <li class="nav-item">
              <a class="nav-link" href="#submenu2" data-toggle="collapse" data-target="#submenu2">Manage ▾</a>
              <ul class="list-unstyled flex-column pl-3 collapse" id="submenu2" aria-expanded="false">
                <li class="nav-item"><a class="nav-link" href="{{ route('users.manageblock') }}">User Clearence</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.managerole') }}">User Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('manageComments') }}">Comments</a></li>
              </ul>
            </li>
          @endif
        @endif
        <li class="nav-item">
          <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Statistics by Department ▾</a>
          <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
            @foreach($departments as $department)
              <li class="nav-item"><a class="nav-link" href="{{ route('layout.departmentStatistics',[$department->id]) }}">{{$department->name}}</a></li>
            @endforeach
          </ul>
        </li>

      </ul>
    </div>



