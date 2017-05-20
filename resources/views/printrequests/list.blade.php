@extends ('layout.master')

@section ('content')

    <div class="col-sm-8">
        <!-- Default panel contents -->
        <h1>Print Requests List</h1>

        <div class="col-sm-8">
            <div class="row">
            <!--{!! Form::open(['method'=>'GET','url'=>'request','class'=>'navbar-form navbar-left','role'=>'search']) !!}-->
                <form method="get" action="{{ route('list') }}">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{old('query')}}" required autofocous>
                        <span class="input-group-btn">
                 <button class="btn btn-default-sm" type="submit">
                     <i class="fa fa-search"></i>
                 </button>
             </span>
                    </div>
                </form>
            <!--{!! Form::close() !!}-->
            </div>
            <div class="col-sm-8 ">
                <a class="btn btn-success" href="">Create new</a>
            </div>
        </div>

        <table class="table table-striped table-bordered">
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
                    <td>{{ $request->users->name }}</td>
                    <td><a class="btn btn-primary" href={{ route('printrequests.show', $request) }}>More</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center">
            {{ $requests->links() }}
        </div>

    </div>





@endsection

@section ('footer')

@endsection
