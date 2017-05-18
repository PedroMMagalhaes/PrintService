@extends ('layout.master')

@section ('content')

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Request Details</div>
  <div class="panel-body">

  <!-- Table -->
  <table class="table table-sm">
    <thead>
      <tr>
        <th>Description</th>
        <th>Request Date</th>
        <th>Color or Black and White</th>
        <th>Print Type</th>
        <th>Stampled?</th>
        <th>Paper Dimension</th>
        <th>Paper Type</th>
        <th>Download Link</th>
        <th>Request State</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">{{$requestData->description}}</th>
        <td>{{$requestData->created_at}}</td>
        <td>@if($requestData->colored == 1)
            {{"Color"}}
        @else
            {{"Black and White"}}
        @endif</td>
        <td>@if($requestData->front_back == 1)
            {{"Double Sided"}}
        @else
            {{"Single Sided"}}
        @endif</td>
        <td>
        @if($requestData->stapled == 1)
            {{"Yes"}}
        @else {{"No"}}
        @endif
             </td>
        <td>{{$requestData->paper_size}}</td>
        <td>{{$requestData->paper_type}}</td>
        <td><a href="{{action('PrintRequestsController@download',$requestData->id)}}">Download</a></td>
        <td>
        @if($requestData->status == 1)
    {{"Complete"}}
        @else {{"In process"}}
        @endif
             </td>
      </tr>
    </tbody>
  </table>
    <div class="panel-heading">Employee</div>
  <table class="table table-sm">
    <thead>
      <tr>
        <th>Name</th>
        <th>Department</th>
        <th>Email</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">{{$userData->name}}</th>
        <td>{{$userDepartment->name}}</td>
        <td>{{$userData->email}}</td>
        <td>{{$userData->phone}}</td>
        <td><a class="btn btn-primary" href="{{action('PrintRequestsController@setComplete',$requestData->id)}}">Complete Request</a></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
  </div>

  <div class="comments">
      <ul class="list-group">
      @foreach ($request->comments as $comment)
      <li class="list-group-item">
          <strong>
              {{$comment->created_at}}
          </strong>
          {{$comment->comment}}
      </li>
      @endforeach
        </ul>
  </div>

@endsection

@section ('footer')

@endsection
