@extends ('layout.master')

@section('content')


@can('create', App\User::class)
<div>
    <a class="btn btn-primary" href="{{route('users.create')}}">Add user</a>
</div>
@endcan

@if(count($users))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>
            <th>Registered At</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->typeToStr() }}</td>
            <td>
            @can('update', $user)
                <a class="btn btn-xs btn-primary" href="{{route('users.edit', [$user->id])}}">Edit</a>
            @endcan
            @can('delete', $user)
                <form action="{{route('users.destroy', [$user->id])}}" method="post" class="inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                    </div>

                </form>
            @endcan
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif

 @include('layout.errors')

@endsection
