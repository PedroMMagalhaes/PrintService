@extends ('layout.master')

@section ('content')

    <div class="col-sm-8">
        <!-- Default panel contents -->
        <h1>Dashboard</h1>
        <div class="container">

                <div class="row">
                    <div clas="col-sm-6">
                    <!--{!! Form::open(['method'=>'GET','url'=>'request','class'=>'navbar-form navbar-left','role'=>'search']) !!}-->
                        <form method="get" action="{{ route('list') }}">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                       value="{{old('query')}}" required autofocous>
                                <span class="input-group-btn">
                            <button class="btn btn-default-sm" type="submit">
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
                <th><a href={{ route('printrequests.order',['criteria' => "desc", 'order' => $order]) }}></a>Description</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'date','order' => $order]) }}></a>Due Date</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'empl','order' => $order]) }}></a>Employee</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'depa','order' => $order]) }}></a>Department</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'stat','order' => $order]) }}></a>Status</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'pape','order' => $order]) }}></a>Paper Type</th>
                <th>Actions</th>
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
                    <td>
                        <a class="btn btn-success" href={{ route('printrequests.show', $request->id) }}>Details</a>
                        @if(!$request->status==1)
                            <a class="btn btn-primary" href={{ route('printrequests.update', $request->id) }}>Edit</a>
                            <a class="btn btn-danger" href={{ route('printrequests.show', $request->id) }}>Delete</a>
                        @endif
                    </td>
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
