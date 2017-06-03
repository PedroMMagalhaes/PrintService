@extends ('layout.master')

@section ('content')

    <!-- Tabela -->
    <div class="col-lg-9 col-md-8">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-inverse">
                <th colspan="2">Statistics For Department {{$data2['department']->name}}</th>
                </thead>
                <tbody>
                <tr>
                    <td>Total Number Of Prints</td>
                    <td>{{$data2['totalPrints']}}</td>
                </tr>
                <tr>
                    <td>Percentage Of Prints By Type</td>
                    <td>Black/White - {{$data2['printwithoutcolorpercent']}}%     |     Color - {{$data2['printwithcolorpercent']}}%</td>
                </tr>
                <tr>
                    <td>Today's Number of Prints</td>
                    <td>{{$data2['todaysPrints']}}</td>
                </tr>
                <tr>
                    <td>Daily average of prints for the current month</td>
                    <td>{{$data2['averageRequestsDay']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section ('footer')

@endsection
