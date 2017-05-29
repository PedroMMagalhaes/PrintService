@extends ('layout.master')


@section('content')


    <div class="col-sm-8">

        <!-- Erros .... -->

        @include('layout.errors')

        <h1> Edit Request </h1>

        <form action="{{route('printrequests.update',$request->id)}}" method="post" class="form-group">
            <input type="hidden" name="request_id" value="<?= (int) $request->request_id?>" />


            {{ csrf_field() }}

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name ="description" placeholder="Description" value="{{ old('description', $request['description'])}}"/>
            </div>

            <div class="form-group">
                <label for="due_date">Due date</label>
                <input type="date" class="form-control" id="due_date" name ="due_date" placeholder="Due date" value="{{ old('due_date', $request['due_date'])}}"/>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" min="1" class="form-control" id="quantity" name ="quantity" placeholder="Quantity" value="{{ old('quantity', $request['quantity'])}}"/>
            </div>

            <div class="form-group">
                <label for="print_type">Print type</label>
                <select name="print_type" id="print_type" class="form-control" value="{{ old('print_type', $request->print_type)}}">
                    <option value="0">Black/White</option>
                    <option value="1">Color</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Staple</label>
                <select name="stapled" id="stapled" class="form-control" value="{{ old('stapled', $request->stapled)}}">
                    <option value="1">With</option>
                    <option value="0">Without</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper size</label>
                <select name="paper_size" id="paper_size" class="form-control" value="{{ old('paper_size', $request->paper_size)}}">
                    <option value="4">A4</option>
                    <option value="3">A3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper type</label>
                <select name="paper_type" id="paper_type" class="form-control" value="{{ old('paper_type', $request->paper_type)}}">
                    <option value="0">Draft</option>
                    <option value="1">Normal</option>
                    <option value="2">Photographic</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <br>
                <input type="file" name="file" id="file">
                </br>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a class="btn btn-default btn-close" href="{{ route('printrequests.dashboard') }}">Cancel</a>
            </div>

        </form>

    </div>
@endsection
