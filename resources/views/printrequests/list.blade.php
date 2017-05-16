@extends ('layout.master')

@section ('content')

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h1>Print Requests List<h1></div>
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
        @foreach ($fetchRequests as $request)
          <tr>
            <td>{{ $request->description }}</td>
            <td>{{ $request->due_date }}</td>
            <td>{{ $request->users->name}}</td>
            <td><a class="btn btn-primary" href={{ route('printrequests.show', $request) }}>More</a></td>
          </tr>
        @endforeach

      </tbody>
    </table>
    {{$fetchRequests->links()}}


  </div>

@endsection

@section ('footer')

@endsection
