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
        <td>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</div>
  @if ($request->status == "0")
  {{Form::open(array('route' => array('printrequests.complete', $requestData->id), 'method' => 'POST'))}}
    <div class="form-group">
      {{Form::select('name', $printers, $printers[1])}}
      {{Form::submit('Complete Request')}}
      </div>
       {{ Form::close() }}
      @endif
      @if ($request->status == "1" && is_null($request->satisfaction_grade))
      <p>
          How satisfacted are you with the printing quality?
      </p>
      {{Form::open(array('route' => array('printrequests.setRating', $requestData->id), 'method' => 'POST'))}}

          <div class="form-group">
      {{ Form::radio('satisfaction', '1') }}1<br/>
              {{ Form::radio('satisfaction', '2') }}2<br/>
               {{ Form::radio('satisfaction', '3',true) }}3<br/>
    {{Form::submit('Rate')}}

</div>
    {{ Form::close() }}
    @else
    @if (is_null($request->satisfaction_grade)==false)
    {{"You rated this printing as $requestData->satisfaction_grade, thank you for your feedback."}}

          @endif
    @endif
    @if($request->status == "0" && is_null($request->refused_reason))
    {{Form::open(array('route' => array('printrequests.refuseRequest', $requestData->id), 'method' => 'POST'))}}
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('refuseReason') ? ' has-error' : '' }}">
        <label for="refuseReason" class="col-md-4 control-label">refuseReason</label>
        <div class="col-md-6">
            <input id="refuseReason" type="text" class="form-control" name="refuseReason" value="" required autofocus>
            {{Form::submit('Refuse Request')}}
            @if ($errors->has('refuseReason'))
                <span class="help-block">
                    <strong>{{ $errors->first('refuseReason') }}</strong>
                </span>
            @endif
            @endif
</div>
</div>

</div>
{{ Form::close() }}
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
