@extends ('layout.master')

@section ('content')

    <div class="col-sm-8">

        <h1>Print Requests List</h1>
        <div class="container">

                <div class="row">
                    <div clas="col-sm-6">
                    <!--{!! Form::open(['method'=>'GET','url'=>'request','class'=>'navbar-form navbar-left','role'=>'search']) !!}-->
                        <form method="get" action="{{ route('printrequests.order',['criteria' => 'description','order' => $order]) }}">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                       value="{{old('query')}}" required autofocous>
                                <span class="input-group-btn">
                            <button class="btn btn-default-sm" type="submit" value="search">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                            </div>
                        </form>
                    <!--{!! Form::close() !!}-->
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <a class="btn btn-success" href="{{ route('create')}}">Create new</a>
                        </div>
                    </div>
                </div>
        </div>


        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><a href={{ route('printrequests.order',['criteria' => 'description','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Description
                    @if($criteria=='description')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'date','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Due Date
                    @if($criteria=='date')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'employee','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Employee
                    @if($criteria=='employee')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'department','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Department
                    @if($criteria=='department')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                    </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'status','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Status
                    @if($criteria=='status')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                    </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'paper','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Paper Type
                    @if($criteria=='paper')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                    </th>
                <th>Image</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->description }}</td>
                    <td>{{ $request->due_date }}</td>
                    <td>{{ $request->users->name }}</td>
                    <td>{{ $request->users->departToStr()}}</td>
                    <td>{{ $request->typeToStrState()}}</td>
                    <td>{{ $request->typeToStrPaperType()}}</td>
                    <td><img src="{{ route('printrequests.displayImage', ['file'=>$request->file,'ownerID'=>$request->owner_id]) }}"></td>
                    <td><a class="btn btn-primary" href="{{ route('printrequests.show', $request->id) }}">More</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center" style="...">
            {{ $requests->links() }}
        </div>

    </div>





@endsection

@section ('footer')

@endsection
