@extends ('layout.master')


@section('content')


  <div class="col-sm-8">


        <h1> Register</h1>

         <form method="POST" action="/register">

            {{ csrf_field() }}


            <div class "form-group">

              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name ="name" required>

            </div>



            <div class "form-group">

              <label for="email">Email:</label>

              <input type="email" class="form-control" id="email" name ="email">

              <input type="email" class="form-control" id="email" name ="email" required>


            </div>


            <div class "form-group">

              <label for="password">Password:</label>

              <input type="password" class="form-control" id="password" name ="password">

              <input type="password" class="form-control" id="password" name ="password" required>


            </div>

            <div class "form-group">

              <label for="password_confirmation">Password Confirmation:</label>
              <input type="password" class="form-control" id="password_confirmation" name ="password_confirmation" required>

            </div>



           <div class="checkbox checkbox-success">
                    <label for="checkbox">Admin:</label>
                    <input name="admin" id="admin" type="checkbox" value="1" required>
                </div>



            <div class="checkbox checkbox-success">
                    <label for="checkbox">Blocked:</label>
                    <input name="blocked" id="blocked" type="checkbox" value="1" required>
                </div>



                <div class "form-group">

                  <label for="department_id">Department ID:</label>
                  <input type="number" class="form-control" id="department_id" name ="department_id" required>

                </div>


                <!--  <div class "form-group">

                  <label for="admin">Admin:</label>
                  <input type="admin" class="form-control" id="admin" name ="admin">

                </div>

                <div class "form-group">

                  <label for="blocked">Blocked:</label>
                  <input type="blocked" class="form-control" id="blocked" name ="blocked">

                </div>-->

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

            <!-- Erros .... -->

                @include('layout.errors')

        </form>

  </div>

@endsection
