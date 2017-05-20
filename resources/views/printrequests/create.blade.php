
@extends ('layout.master')


@section('content')


    <div class="col-sm-8">


        <h1> Create a New Request</h1>

        <form method="POST" action="{{route('printrequests.store')}}">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name ="description" required>
            </div>


            <div class="form-group">

                <label for="due_date">Due date</label>

                <input type="date" class="form-control" id="due_date" name ="due_date" required>

            </div>


            <div class="form-group">

                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name ="quantity" required>


            </div>

            <div class="form-group">

                <label for="print_type">Print type</label>
                <br>
                <input type="radio" name="print_type" value="Black/White" checked> Black/White<br>
                <input type="radio" name="print_type" value="Colored">Colored<br>
            </div>

            <div class="form-group">
                <label for="stapled">Stapled</label>
                <br>
                <input type="radio" name="stapled" value="true" checked> Stapled<br>
                <input type="radio" name="stapled" value="false">Not stapled<br>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>

            <!-- Erros .... -->

            @include('layout.errors')

        </form>

    </div>
@endsection
