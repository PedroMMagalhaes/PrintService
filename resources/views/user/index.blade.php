
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


        @if(count($users))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Phone Number</th>
                    {{--<th>Registered At</th>
                    <th>Type</th>
                    <th>Print Evals</th>
                    <th>Print Count</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->departToStr() }}</td>
                        <td>{{ $user->phone }}</td>
                        {{--<td>{{ $user->created_at }}</td>
                        <td>{{ $user->typeToStr() }}</td>
                        <td>{{ $user->print_evals }}</td>
                        <td>{{ $user->print_counts }}</td>--}}
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
