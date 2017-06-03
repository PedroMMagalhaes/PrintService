@extends ('layout.master')

@section ('content')

    <div class="col-sm-8">
        <!-- Default panel contents -->
        <h1>Request Details</h1>

        <!-- Table -->
        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th>Description</th>
                <th>Request Date</th>
                <th>Color or Black and White</th>
                <th>Print Type</th>
                <th>Stampled?</th>
                <th>Paper Size</th>
                <th>Paper Type</th>
                <th>Download Link</th>
                <th>Request State</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$requestData->description}}</th>
                <td>{{$requestData->created_at}}</td>
                <td>{{$requestData->typeToStrColored()}}</td>
                <td>{{$requestData->typeToStrFrontBack()}}</td>
                <td>{{$requestData->typeToStrStampled()}}</td>
                <td>{{$requestData->typeToStrPaperSize()}}</td>
                <td>{{$requestData->typeToStrPaperType()}}</td>
                <td><a href="{{action('PrintRequestsController@download',$requestData->id)}}">Download</a></td>
                <td>{{$requestData->typeToStrState()}}</td>
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
        @if($user->isAdmin())
        @if($requestData->status == "0")
            {{Form::open(array('route' => array('printrequests.complete', $requestData->id), 'method' => 'POST'))}}
            <div class="form-group">
                {{Form::select('name', $printers, $printers[1])}}
                {{Form::submit('Complete Request')}}
            </div>
            {{ Form::close() }}
        @endif
        @endif
        @if($user->isPublisher())
        @if ($requestData->status == "1" && is_null($requestData->satisfaction_grade))
            <p>
                How satisfacted are you with the printing quality?
            </p>
            {{Form::open(array('route' => array('printrequests.setRating', $requestData->id), 'method' => 'POST'))}}

            <div class="form-group ">
                {{ Form::radio('satisfaction', '1') }}1<br/>
                {{ Form::radio('satisfaction', '2') }}2<br/>
                {{ Form::radio('satisfaction', '3',true) }}3<br/>
                {{Form::submit('Rate')}}

            </div>
            {{ Form::close() }}
        @else
            @if (is_null($requestData->satisfaction_grade)==false)
                {{"You rated this printing as $requestData->satisfaction_grade, thank you for your feedback."}}

            @endif
        @endif
        @endif
        @if($user->isAdmin())
        @if($requestData->status == "0" && is_null($requestData->refused_reason))
            {{Form::open(array('route' => array('printrequests.refuseRequest', $requestData->id), 'method' => 'POST'))}}
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('refuseReason') ? ' has-error' : '' }}">
                <label for="refuseReason" class="col-md-4 control-label">Refuse Reason</label>
                <div class="col-md-6">
                    <input id="refuseReason" type="text" class="form-control" name="refuseReason" value="" required
                           autofocus>
                    {{Form::submit('Refuse Request')}}
                    @if ($errors->has('refuseReason'))
                        <span class="help-block">
                    <strong>{{ $errors->first('refuseReason') }}</strong>
                </span>
                    @endif
                    @endif
                    @endif
                </div>
            </div>
            {{ Form::close() }}
            <div class="comments">
                <ul class="list-group">
                    @foreach ($comments as $comment)
                        @if($comment->blocked==0)
                        @if(is_null($comment->parent_id))
                        <li class="list-group-item">
                            <strong>
                                 {{$comment->users['name']}}
                                 commented at {{$comment->created_at}} &nbsp;
                            </strong>
                            {{$comment->comment}}
                        </li>
                        @if($user->isAdmin())
                        <p><a class="btn btn-primary" href={{ route('comments.block', ['requestID' => $requestData->id, 'commentID' => $comment->id]) }}>Block</a></p>
                        @endif
                        @foreach ($comments as $subcomment)
                        @if($comment->id==$subcomment->parent_id && $subcomment->blocked==0)
                        <li class="list-group-item list-group-item-info">
                            <strong>
                                 {{$subcomment->users['name']}}
                                commented at {{$subcomment->created_at}} &nbsp;
                            </strong>
                             {{$subcomment->comment}}
                        </li>
                        @if($user->isAdmin())
                        <p><a class="btn btn-primary" href={{ route('comments.block', ['requestID' => $requestData->id, 'commentID' => $subcomment->id]) }}>Block</a></p>
                        @endif
                        @endif
                        @endforeach
                        @if($requestData->status==0)
                        {{Form::open(array('route' => array('comments.create',$requestData->id,$comment->id), 'method' => 'POST'))}}
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <input id="comment" type="text" class="form-control" name="comment" value="" required
                               autofocus>
                        {{Form::submit('Reply to Comment Thread')}}
                        @if ($errors->has('comment'))
                            <span class="help-block">
                        <strong>{{ $errors->first('comment') }}</strong>
                        @endif
                        </div>
                        {{ Form::close() }}
                        @endif
                        @endif
                        @endif
                    @endforeach
                    @if($requestData->status==0)
                    {{Form::open(array('route' => array('comments.create',$requestData->id), 'method' => 'POST'))}}
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <input id="comment" type="text" class="form-control" name="comment" value="" required
                           autofocus>
                    {{Form::submit('New Comment')}}
                    @if ($errors->has('comment'))
                        <span class="help-block">
                    <strong>{{ $errors->first('comment') }}</strong>
                    @endif
                    </div>
                    {{ Form::close() }}
                    @endif
                </ul>
            </div>
                <a href="{{ route('list') }}" class="btn btn-primary">Back</a>
            <div class="text-center" style="...">
                    {{ $comments->links() }}
            </div>
    </div>



@endsection

@section ('footer')

@endsection
