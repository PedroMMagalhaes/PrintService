
@extends ('layout.master')

@section('content')


    <div class = "col-md-8">

        <h2> Normal Users List</h2>
        <br/>

        @if(count($normalUsers))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Phone Number</th>
                    <th>Registered At</th>
                    <th>Type</th>
                    <th>Print Evals</th>
                    <th>Print Count</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($normalUsers as $normalUser)
                    <tr>
                        <td>{{ $normalUser->name }}</td>
                        <td>{{ $normalUser->email }}</td>
                        <td>{{ $normalUser->departToStr() }}</td>
                        <td>{{ $normalUser->phone }}</td>
                        <td>{{ $normalUser->created_at }}</td>
                        <td>{{ $normalUser->typeToStr() }}</td>
                        <td>{{ $normalUser->print_evals }}</td>
                        <td>{{ $normalUser->print_counts }}</td>
                        <td>
                            <a class="btn btn-xs btn-success" href="{{route('users.getAdmin', $normalUser->id)}}">Make Admin</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No unblocked users found</h2>
        @endif

        <div class="text-center">
            {{ $normalUsers->links() }}
        </div>

        <br/>

        <h2> Admin Users List</h2>
        <br/>

        @if(count($adminUsers))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Phone Number</th>
                    <th>Registered At</th>
                    <th>Type</th>
                    <th>Print Evals</th>
                    <th>Print Count</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($adminUsers as $adminUser)
                    <tr>
                        <td>{{ $adminUser->name }}</td>
                        <td>{{ $adminUser->email }}</td>
                        <td>{{ $adminUser->departToStr() }}</td>
                        <td>{{ $adminUser->phone }}</td>
                        <td>{{ $adminUser->created_at }}</td>
                        <td>{{ $adminUser->typeToStr() }}</td>
                        <td>{{ $adminUser->print_evals }}</td>
                        <td>{{ $adminUser->print_counts }}</td>
                        <td>
                            <a class="btn btn-xs btn-danger" href="{{route('users.removeAdmin', $adminUser->id)}}">Remove Privileges</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No blocked users found</h2>
        @endif

        <div class="text-center">
            {{ $adminUsers->links() }}
        </div>



    </div>


@endsection