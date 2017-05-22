@extends ('layout.master')


@section('content')


    <div class="col-sm-8">

        <!-- Erros .... -->

        @include('layout.errors')
        @if(Session::has('message'))
            <div class="alert alert-success fade in alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>

                {{Session::get('message')}}
            </div>
        @endif

        <h1> Edit Request </h1>

        <form method="POST" action="{{route('printrequests.dashboard')}}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name ="description" placeholder="Description" value="{{old('description', $request->email)}}>
            </div>

            <div class="form-group">
                <label for="due_date">Due date</label>
                <input type="date" class="form-control" id="due_date" name ="due_date">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" min="1" class="form-control" id="quantity" name ="quantity">
            </div>

            <div class="form-group">
                <label for="print_type">Print type</label>
                <select name="print_type" id="print_type" class="form-control">
                    <option disabled selected> -- select an option -- </option>
                    <option value="0">Black/White</option>
                    <option value="1">Color</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Staple</label>
                <select name="stapled" id="stapled" class="form-control">
                    <option disabled selected> -- select an option -- </option>
                    <option value="1">With</option>
                    <option value="0">Without</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper size</label>
                <select name="paper_size" id="paper_size" class="form-control">
                    <option disabled selected> -- select an option -- </option>
                    <option value="4">A4</option>
                    <option value="3">A3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper type</label>
                <select name="paper_type" id="paper_type" class="form-control">
                    <option disabled selected> -- select an option -- </option>
                    <option value="0">Draft</option>
                    <option value="1">Normal</option>
                    <option value="2">Photographic</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <br>
                <input type="file" name="file" id="file"><br>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
            </div>

        </form>

    </div>
@endsection
