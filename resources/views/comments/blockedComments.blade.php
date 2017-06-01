


@extends ('layout.master')

@section('content')


    <div class = "col-md-8">


        <h2> Blocked Comments List</h2>
        <br/>

        @if(count($blockedComments))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Blocked Comments</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blockedComments as $blockedComment)
                    <tr>
                        <td>{{ $blockedComment->comment }}</td>
                        <td>{{ $blockedComment->created_at }}</td>
                        <td>{{ $blockedComment->users->name }}</td>

                        <td>
                            <a class="btn btn-xs btn-success" href="{{route('comments.unblock', $blockedComment->blocked)}}">Unblock</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No blocked comments found</h2>
        @endif

        <div class="text-center">
            {{ $blockedComments->links() }}
        </div>

    </div>


@endsection