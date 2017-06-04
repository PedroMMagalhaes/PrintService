@extends ('layout.master')


@section('content')


    <div class="col-sm-8">

        <!-- Erros .... -->
        @if(count($errors) > 0)
            @include('layout.errors')
        @endif

        @include('partials.flashmessages')

        <h1> Create a New Request</h1>

        <form method="POST" action="{{route('printrequests.store')}}" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>

            <div class="form-group">
                <label for="due_date">Due date</label>
                <input type="date" class="form-control" id="due_date" name="due_date">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" min="1" class="form-control" id="quantity" name="quantity">
            </div>

            <div class="form-group">
                <label for="colored">Print type</label>
                <select name="colored" id="colored" class="form-control">
                    <option disabled selected> -- select an option --</option>
                    <option value="0">Black/White</option>
                    <option value="1">Color</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Staple</label>
                <select name="stapled" id="stapled" class="form-control">
                    <option disabled selected> -- select an option --</option>
                    <option value="1">With</option>
                    <option value="0">Without</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper size</label>
                <select name="paper_size" id="paper_size" class="form-control">
                    <option disabled selected> -- select an option --</option>
                    <option value="4">A4</option>
                    <option value="3">A3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper type</label>
                <select name="paper_type" id="paper_type" class="form-control">
                    <option disabled selected> -- select an option --</option>
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
                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-default btn-close" href="{{ route('home') }}">Cancel</a>
            </div>

        </form>

    </div>
@endsection
