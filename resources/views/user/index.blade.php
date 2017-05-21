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
            <th>Email</th>
            <th>Fullname</th>
            <th>Department</th>
            <th>Registered At</th>
            <th>Type</th>
            <th>Print Evals</th>
            <th>Print Count</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->departToStr() }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->typeToStr() }}</td>
            <td>{{ $user->print_evals }}</td>
            <td>{{ $user->print_counts }}</td>
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
    <div class="text-center">
        {{ $users->links() }}
    </div>

      @endsection
