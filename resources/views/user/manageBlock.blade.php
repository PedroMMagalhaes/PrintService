@extends ('layout.master')

@section('content')


    <div class="col-md-8">


        <h2> Blocked Users List</h2>
        <br/>

        @if(count($blockedUsers))
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
                @foreach ($blockedUsers as $blockedUser)
                    <tr>
                        <td>{{ $blockedUser->name }}</td>
                        <td>{{ $blockedUser->email }}</td>
                        <td>{{ $blockedUser->departToStr() }}</td>
                        <td>{{ $blockedUser->phone }}</td>
                        <td>{{ $blockedUser->created_at }}</td>
                        <td>{{ $blockedUser->typeToStr() }}</td>
                        <td>{{ $blockedUser->print_evals }}</td>
                        <td>{{ $blockedUser->print_counts }}</td>
                        <td>
                            <a class="btn btn-xs btn-success" href="{{route('users.unblock', $blockedUser->id)}}">Unblock</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No blocked users found</h2>
        @endif

        <div class="text-center">
            {{ $blockedUsers->links() }}
        </div>

        <br/>

        <h2> Unblocked Users List</h2>
        <br/>

        @if(count($unblockedUsers))
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
                @foreach ($unblockedUsers as $unblockedUser)
                    <tr>
                        <td>{{ $unblockedUser->name }}</td>
                        <td>{{ $unblockedUser->email }}</td>
                        <td>{{ $unblockedUser->departToStr() }}</td>
                        <td>{{ $unblockedUser->phone }}</td>
                        <td>{{ $unblockedUser->created_at }}</td>
                        <td>{{ $unblockedUser->typeToStr() }}</td>
                        <td>{{ $unblockedUser->print_evals }}</td>
                        <td>{{ $unblockedUser->print_counts }}</td>
                        <td>
                            <a class="btn btn-xs btn-danger"
                               href="{{route('users.block', $unblockedUser->id)}}">Block</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No unblocked users found</h2>
        @endif

        <div class="text-center">
            {{ $unblockedUsers->links() }}
        </div>


    </div>


@endsection