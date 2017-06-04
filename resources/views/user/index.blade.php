
@extends ('layout.master')

@section('content')


    <div class = "col-md-8">

        <h2> Users List</h2>
        <br/>
        @can('create', App\User::class)
            <div>
                <a class="btn btn-primary" href="{{route('register')}}">Add user</a>
            </div>
        @endcan
        <div class="container">

                <div class="row">
                    <div clas="col-sm-6">
                        <form method="get" action="{{ route('contacts.order',['criteria' => $criteria,'order' => $order]) }}">
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
                    </div>
                </div>
        </div>


        @if(count($users))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><a href={{ route('contacts.order',['criteria' => 'name','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Name
                        @if($criteria=='name')
                            @if($order=='asc')
                                ▼
                            @else
                                ▲
                            @endif
                        @endif</th>
                    <th><a href={{ route('contacts.order',['criteria' => 'email','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Email
                        @if($criteria=='email')
                        @if($order=='asc')
                            ▼
                        @else
                            ▲
                        @endif
                    @endif</th>
                    <th><a href={{ route('contacts.order',['criteria' => 'department_id','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Department
                        @if($criteria=='department_id')
                            @if($order=='asc')
                                ▼
                            @else
                                ▲
                            @endif
                        @endif</th>
                    <th><a href={{ route('contacts.order',['criteria' => 'phone','order' => $order,'search' => Request::input('search'),'page' => Request::input('page')]) }}>Phone Number
                        @if($criteria=='phone')
                        @if($order=='asc')
                            ▼
                        @else
                            ▲
                        @endif
                    @endif</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->departToStr() }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>

                                <a class="btn btn-xs btn-primary" href="{{route('showProfile', $user)}}">Profile</a>

                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No users found</h2>
        @endif

        <div class="text-center">
            {{ $users->links() }}
        </div>

    </div>
@endsection
