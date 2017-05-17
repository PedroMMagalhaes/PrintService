@extends ('layout.master')

@section ('content')

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h1>Print Requests List<h1></div>
    <div class="col-md-6">
      {!! Form::open(['method'=>'GET','url'=>'printrequests','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
      <div class="input-group custom-search-form">
          <input type="text" class="form-control" name="search" placeholder="Search...">
          <span class="input-group-btn">
              <button class="btn btn-default-sm" type="submit">
                  <i class="fa fa-search"></i>
              </button>
          </span>
      </div>
      {!! Form::close() !!}
    </div>
  <div class="panel-body">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Description</th>
          <th>Due Date</th>
          <th>Employee</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($requests as $request)
          <tr>
            <td>{{ $request->description }}</td>
            <td>{{ $request->due_date }}</td>
            <td>{{ $request->users->name}}</td>
            <td><a class="btn btn-primary" href={{ route('printrequests.show', $request) }}>More</a></td>
          </tr>
        @endforeach

      </tbody>
    </table>
    {!! $requests->links() !!}

  </div>

@endsection

@section ('footer')

@endsection
