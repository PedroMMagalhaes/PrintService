@extends ('layout.master')

@section('content')

  @can('create', App\User::class)
  <div>
      <a class="btn btn-primary" href="{{route('register')}}">Add user</a>
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
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif

 @include('layout.errors')

@endsection
