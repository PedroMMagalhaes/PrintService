@extends ('layout.master')


@section('content')

    <div class="col-md-8">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    @if( Auth::check() )
                        @if(Auth::user()->admin)

                            <label>User status: {{$user->blockedToStr()}}</label>
                            @if($user->blocked == 0)
                                <a class="btn btn-xs btn-danger" href="{{route('users.block', $user->id)}}">Block This
                                    user</a>
                            @endif
                        @endif
                    @endif

                        <img src="/img/profile_photo{{ $user->profile_photo }}"
                             style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        <h2>{{ $user->name}}'s Profile </h2>
                        @if( Auth::check() )
                            @if (Auth::user()->id === $user->id)
                                <form enctype="multipart/form-data" action="{{ route('update_avatar') }} "
                                      method="post">
                                    <label>Update Profile Image</label>
                                    <input type="file" name="profile_photo">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                                </form>

                                <br/>
                                <br/>
                                <br/>


                                <div class="container">
                                    <p><h5> Update password </h5></p>

                                    <form method="POST" action="{{ route('update_profile') }}">

                                        <div class="form-group">
                                            {{ csrf_field() }}

                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   required>
                                        </div>

                                        <div class="form-group">

                                            <label for="password_confirmation">Password Confirmation</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                   name="password_confirmation" required>

                                        </div>

                                        <br/>

                                        <div class="form-group">

                                            <button type="submit" class="btn btn-primary">Update</button>

                                        </div>

                                        <!-- Erros .... -->

                                        @include('layout.errors')
                                    </form>
                                    <a class="btn btn-xs btn-primary" href="{{route('users.edit', $user)}}">Update more
                                        details</a>

                                </div>
                            @endif
                        @endif

                            <br/>

                            <label>User info</label>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Profile Url</th>
                                    <th>Presentation</th>
                                </tr>

                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->departToStr()}}</td>
                                    <td>{{$user->profile_url}}</td>
                                    <td>{{$user->presentation}}</td>
                                </tr>
                                </tbody>
                            </table>

                </div>
            </div>
        </div>
    </div>



@endsection
