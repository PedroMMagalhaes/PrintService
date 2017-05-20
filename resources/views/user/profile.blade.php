@extends ('layout.master')


@section('content')

<div class = "col-md-8">

  <div class = "container">
    <div class="row">
      <div class="col-md-8 col-md-offset-1">

        <img src ="/img/profile_photo{{ $user->profile_photo }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
        <h2>{{ $user->name}}'s Profile </h2>

        {{ dd($user->toArray()) }}

        <form enctype="multipart/form-data" action="{{ route('update_avatar') }} "method="post">
                <label>Update Profile Image</label>
                <input type="file" name="profile_photo">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">

            </form>

            <br/>
            <br/>
            <br/>

            <!--<div class = "container">
              <p><h5> Update details </h5></p>

             <form method="POST" action="/update_profile">

               <div class "form-group">

                 <label for="password">Password:</label>
                 <input type="password" class="form-control" id="password" name ="password" required>


               </div>

               <div class "form-group">

                 <label for="password_confirmation">Password Confirmation:</label>
                 <input type="password" class="form-control" id="password_confirmation" name ="password_confirmation" required>

               </div>

               <br/>

               <div class "form-group">

               <button type="submit" class="btn btn-primary">Update</button>

               </div>

               <!-- Erros ....

                   @include('layout.errors')







             </form> -->
           </div>


      </div>
    </div>
  </div>
</div>



@endsection
