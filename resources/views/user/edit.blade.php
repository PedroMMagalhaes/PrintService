@extends('layout.master')

@section('content')


    @include('layout.errors')


    <form action="{{ route('users.update', [$user->id]) }}" method="post" class="form-group">
        <input type="hidden" name="user_id" value="<?= (int)$user->user_id?>"/>

        {{csrf_field()}}

        <div class="form-group">
            <label for="inputName">Name</label>
            <input
                    type="text" class="form-control"
                    name="name" id="inputName"
                    placeholder="Name" value="{{ old('name', $user->name)}}"/>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input
                    type="number" min="9" class="form-control"
                    name="phone" id="phone"
                    placeholder="Phone Number" value="{{ old('phone', $user->phone)}}"/>
        </div>

        <div class="form-group">
            <label for="profile_url">Profile url</label>
            <input
                    type="text" class="form-control"
                    name="profile_url" id="profile_url"
                    placeholder="Profile url" value="{{ old('profile_url', $user->profile_url)}}"/>
        </div>
        <div class="form-group">
            <label for="presentation">Presentation</label>
            <input
                    type="text" class="form-control"
                    name="presentation" id="presentation"
                    placeholder="Presentation" value="{{ old('presentation', $user->presentation)}}"/>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="ok">Save</button>
            <a href="{{ route('profile') }}" class="btn btn-primary">Cancel</a>
        </div>

    </form>
@endsection
