@extends ('layout.master')


@section('content')


    <div class="col-sm-8">

        <!-- Erros .... -->

        @include('layout.errors')

        <h1> Edit Request </h1>

        <form method="POST" action="{{route('printrequests.update',$request->id)}}" enctype="multipart/form-data" class="form-group">
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
                <select name="print_type" id="print_type" class="form-control">
                    <option value="0" @if(old('print_type',$request->print_type)==0) selected @endif>Black/White</option>
                    <option value="1" @if(old('print_type',$request->print_type)==1) selected @endif>Color</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Staple</label>
                <select name="stapled" id="stapled" class="form-control">
                    <option value="1" @if(old('stapled', $request->stapled)==1) selected @endif>With</option>
                    <option value="0" @if(old('stapled', $request->stapled)==0) selected @endif>Without</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper size</label>
                <select name="paper_size" id="paper_size" class="form-control" value="{{ old('paper_size', $request->paper_size)}}">
                    <option value="4" @if(old('paper_size', $request->paper_size)==4) selected @endif>A4</option>
                    <option value="3" @if(old('paper_size', $request->paper_size)==3) selected @endif>A3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stapled">Paper type</label>
                <select name="paper_type" id="paper_type" class="form-control" value="{{ old('paper_type', $request->paper_type)}}">
                    <option value="0" @if(old('paper_type', $request->paper_type)==0) selected @endif>Draft</option>
                    <option value="1" @if(old('paper_type', $request->paper_type)==1) selected @endif>Normal</option>
                    <option value="2" @if(old('paper_type', $request->paper_type)==2) selected @endif>Photographic</option>
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
                <a class="btn btn-default btn-close" href="{{ route('list') }}">Cancel</a>
            </div>

        </form>

    </div>
@endsection
