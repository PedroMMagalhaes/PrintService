@extends ('layout.master')


@section('content')


  <div class="col-sm-8">

      <!-- Erros .... -->

      @include('layout.errors')

      <h1> Register</h1>


      @include('layout.flash')

         <form method="POST" action="{{route('register')}}">

            {{ csrf_field() }}

            <div class="form-group">

              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name ="name" required>

            </div>


            <div class="form-group">

              <label for="email">Email:</label>

              <input type="email" class="form-control" id="email" name ="email" required>


            </div>


            <div class="form-group">

              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name ="password" required>


            </div>

            <div class="form-group">

              <label for="password_confirmation">Password Confirmation:</label>
              <input type="password" class="form-control" id="password_confirmation" name ="password_confirmation" required>

            </div>



            <input type="hidden" name="admin" value="0" />

            <input type="hidden" name="blocked" value="0" />



                <div class="form-group">

                  <label for="department_id">Department:</label>
                  <!--<input type="number" class="form-control" id="department_id" name ="department_id" required> -->

                    <select name="department_id" class="form-control">
                        <option disabled selected> -- select an option --</option>
                        <option value="1">Ciências Jurídicas</option>
                        <option value="2">Ciências da Linguagem</option>
                        <option value="3">Engenharia do Ambiente</option>
                        <option value="4">Engenharia Civil</option>
                        <option value="5">Engenharia Eletrotécnica</option>
                        <option value="6">Engenharia Informática</option>
                        <option value="7">Engenharia Mecânica</option>
                        <option value="8">Gestão e Economia</option>
                        <option value="9">Matemática</option>
                    </select>

                </div>


                <!--  <div class "form-group">

                  <label for="admin">Admin:</label>
                  <input type="admin" class="form-control" id="admin" name ="admin">

                </div>

                <div class "form-group">

                  <label for="blocked">Blocked:</label>
                  <input type="blocked" class="form-control" id="blocked" name ="blocked">

                </div>-->

            <div class="form-group">

              <label for="phone">Phone:</label>
              <input type="tel" class="form-control" id="phone" name ="phone">

            </div>


            <input type="hidden" name="print_evals" value="0" />

            <input type="hidden" name="print_counts" value="0" />

          

            <div class="form-group">

            <button type="submit" class="btn btn-primary">Register</button>
            <a class="btn btn-default btn-close" href="{{ route('home') }}">Cancel</a>

            </div>

        </form>

  </div>

@endsection
