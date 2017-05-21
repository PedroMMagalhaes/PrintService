@extends('layout.master')

@section('content')


    @include('layout.errors')


<form action="{{ route('users.update', [$user->id]) }}" method="post" class="form-group">
    <input type="hidden" name="user_id" value="<?= (int) $user->user_id?>" />

    {{csrf_field()}}

    <div class="form-group">
        <label for="inputName">Name</label>
        <input
            type="text" class="form-control"
            name="name" id="inputName"
            placeholder="Name" value="{{ old('name', $user->name)}}" />
    </div>
    <div class="form-group">
        <label for="inputType">Type</label>
        <select name="type" id="inputType" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @if ($user->type == 1)
                <option value="1" selected>Administrator</option>
                <option value="0" >Functionary</option>

            @elseif ($user->type == 0)
                <option value="1" >Administrator</option>
                <option value="0" selected>Functionary</option>

            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input
            type="email" class="form-control"
            name="email" id="inputEmail"
            placeholder="Email address" value="{{old('email', $user->email)}}"/>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Save</button>
        <a class="btn" href="{{route('index')}}">Cancel</a>
    </div>
</form>
@endsection
