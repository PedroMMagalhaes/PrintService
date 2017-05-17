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
        <td><?php
        if($requestData->colored == 1)
        echo("Color");
        else echo ("Black and White");
             ?></td>
        <td><?php
        if($requestData->front_back == 1)
        echo("Double Sided");
        else echo ("Single Sided");
             ?></td>
        <td><?php
        if($requestData->stapled == 1)
        echo("Yes");
        else echo ("No");
             ?></td>
        <td>{{$requestData->paper_size}}</td>
        <td>{{$requestData->paper_type}}</td>
        <td><a href="{{action('PrintRequestsController@download',$requestData->id)}}">Download</a></td>
        <td><?php
        if($requestData->status == 1)
        echo("Complete");
        else echo ("In process");
             ?></td>
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
