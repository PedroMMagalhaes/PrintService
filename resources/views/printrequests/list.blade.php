@extends ('layout.master')

@section ('content')

    <div class="col-sm-8">
        <!-- Default panel contents -->
        <h1>Print Requests List</h1>
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
                <th><a href={{ route('printrequests.order',['criteria' => "desc", 'order' => $order]) }}>Description</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'date','order' => $order]) }}>Due Date</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'empl','order' => $order]) }}>Employee</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'depa','order' => $order]) }}>Department</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'stat','order' => $order]) }}>Status</th>
                <th><a href={{ route('printrequests.order',['criteria' => 'pape','order' => $order]) }}>Paper Type</th>
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
                    <td><a class="btn btn-primary" href={{ route('printrequests.show', $request->id) }}>More</a></td>
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
