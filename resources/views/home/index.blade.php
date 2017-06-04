@extends ('layout.master')


@section ('content')


    <div class="col-sm-8">

        @if(count($errors) > 0)
            @include('layout.errors')
        @endif
        @include('partials.flashmessages')


        <div class="row mb-3">
            <div class="col-xl-3 col-lg-6">
                <div class="card card-inverse card-success">
                    <div class="card-block bg-success">
                        <div class="rotate">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Nº Of Active Users</h6>
                        <h1 class="display-1">{{$data['totalNumberOfActiveUsers']}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-inverse card-danger">
                    <div class="card-block bg-danger">
                        <div class="rotate">
                            <i class="fa fa-list fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Nº Of Prints</h6>
                        <h1 class="display-1">{{$data['totalNumberOfPrints']}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-inverse card-info">
                    <div class="card-block bg-info">
                        <div class="rotate">
                            <i class="fa fa-twitter fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Today's Number of Prints</h6>
                        <h1 class="display-1">{{$data['todaysPrints']}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-inverse card-warning">
                    <div class="card-block bg-warning">
                        <div class="rotate">
                            <i class="fa fa-share fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Daily average of prints for the current month</h6>
                        <h1 class="display-1">{{$data['averageRequestsDay']}}</h1>
                    </div>
                </div>
            </div>
        </div>


        @section('scripts')

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Type', 'Black/White'],
                        ['Black/White',{{$data['totalNumberOfPrintsWithoutColor']}}],
                        ['Color',{{$data['totalNumberOfPrintsColor']}}],
                    ]);

                    var options = {
                        title: 'Number Of Prints By Type',
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }

            </script>

        @endsection

        <div id="piechart" style="width: 900px; height: 500px;"></div>


        <!-- Tabela -->
        <div class="col-lg-9 col-md-8">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-inverse">
                    <th colspan="2">Statistics</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Total Number Of Prints</td>
                        <td>{{$data['totalNumberOfPrints']}}</td>
                    </tr>
                    <tr>
                        <td>Number Of Prints By Type</td>
                        <td>Black/White({{$data['totalNumberOfPrintsWithoutColor']}})
                            - {{$data['printwithoutcolorpercent']}}% | Color({{$data['totalNumberOfPrintsColor']}})
                            - {{$data['printwithcolorpercent']}}%
                        </td>
                    </tr>
                    <tr>
                        <td>Today's Number of Prints</td>
                        <td>{{$data['todaysPrints']}}</td>
                    </tr>
                    <tr>
                        <td>Daily average of prints for the current month</td>
                        <td>{{$data['averageRequestsDay']}}</td>
                    </tr>
                    <tr>
                        <td>Total Nº Of Active Users</td>
                        <td>{{$data['totalNumberOfActiveUsers']}}</td>
                    </tr>
                    <thead class="thead-inverse">
                    <th colspan="2">
                        Total Number Of Prints by Department
                    </th>
                    @foreach($data['countRequests'] as $request)
                        <tr>
                            <td>{{$request['department_name']}}</td>
                            <td>{{$request['number_of_prints']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
