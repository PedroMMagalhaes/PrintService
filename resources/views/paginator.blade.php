{{$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator)}}

@if($paginator->getLastPage() > 1)
    <ul class="pagination">
        {{$presenter->render()}}
        <li>
            {{Form::open(array('url' => $paginator->getUrl(0), 'method' => 'GET'))}}
            <input type="number" name="page" min="0" max="{{$paginator->getLastPage()}}" value="{{$paginator->getCurrentPage()}}" placeholder="Page #" class="form-control" style="width: 150px; float: left; margin-left: 20px;">
            {{Form::close()}}
        </li>
    </ul>
@endif
