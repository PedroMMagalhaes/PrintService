@extends ('layout.master')

@section ('content')

    <div class="col-sm-8">
        <!-- Default panel contents -->
        <h1>Dashboard</h1>
        <div class="container">


                <div class="row">
                    <div clas="col-sm-6">
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
                <th><a href={{ route('printrequests.order',['criteria' => 'description','order' => $order]) }}>Description
                    @if($criteria=='description')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'date','order' => $order]) }}>Due Date
                    @if($criteria=='date')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'employee','order' => $order]) }}>Employee
                    @if($criteria=='employee')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                </th>
                <th><a href={{ route('printrequests.order',['criteria' => 'department','order' => $order]) }}>Department</th>
                    @if($criteria=='department')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                <th><a href={{ route('printrequests.order',['criteria' => 'status','order' => $order]) }}>Status</th>
                    @if($criteria=='status')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                <th><a href={{ route('printrequests.order',['criteria' => 'paper','order' => $order]) }}>Paper Type</th>
                    @if($criteria=='paper')
                    @if($order=='asc')
                    ▲
                    @else
                    ▼
                    @endif
                    @endif
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $requestValue)
                <tr>
                    <td>{{ $requestValue->description }}</td>
                    <td>{{ $requestValue->due_date }}</td>
                    <td>{{ $requestValue->users->name }}</td>
                    <td>{{ $requestValue->users->departToStr()}}</td>
                    <td>{{ $requestValue->typeToStrState()}}</td>
                    <td>{{ $requestValue->typeToStrPaperType()}}</td>
                    <td>
                        <a class="btn btn-success" href={{ route('printrequests.show', [$requestValue->id]) }}>Details</a>
                        @if(!$requestValue->status==1)
                            @can('update', $requestValue)
                                <a class="btn btn-primary" href="{{ route('printrequests.edit', [$requestValue->id]) }}">Edit</a>
                            @endcan

                            <a class="btn btn-danger" href="{{ route('printrequests.destroy', [$requestValue->id]) }}">Delete</a>
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
