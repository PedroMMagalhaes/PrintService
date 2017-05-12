@extends ('layout.master')


@section('content')


  <div class="col-sm-8">


    @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif


        <h1> Register</h1>

         <form method="POST" action="/register">

            {{ csrf_field() }}


            <div class "form-group">

              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name ="name">

            </div>



            <div class "form-group">

              <label for="email">Name:</label>
              <input type="email" class="form-control" id="email" name ="email">

            </div>


            <div class "form-group">

              <label for="password">Name:</label>
              <input type="password" class="form-control" id="password" name ="password">

            </div>



            <div class="checkbox checkbox-success">
                    <label for="checkbox">Admin:</label>
                    <input name="admin" id="admin" type="checkbox" value="true">
                </div>


            <div class="checkbox checkbox-success">
                    <label for="checkbox">Blocked:</label>
                    <input name="blocked" id="blocked" type="checkbox" value="true">
                </div>




            <div class "form-group">

              <label for="phone">Phone:</label>
              <input type="tel" class="form-control" id="phone" name ="phone">

            </div>


            <div class "form-group">

              <label for="print_evals">print_evals:</label>
              <input type="number" class="form-control" id="print_evals" name ="print_evals">

            </div>


            <div class "form-group">

              <label for="print_counts">print_counts:</label>
              <input type="number" class="form-control" id="print_counts" name ="print_counts">

            </div>


            <div class "form-group">

            <button type="submit" class="btn btn-primary">Register</button>

            </div>

            <!-- /resources/views/post/create.blade.php -->





        </form>

  </div>

@endsection
