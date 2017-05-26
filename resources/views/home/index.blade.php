@extends ('layout.master')


@section ('content')


<div class="col-sm-8">

<div class="row placeholders mb-3">
  <div class="col-6 col-sm-3 placeholder text-center">
    <img src="//placehold.it/200/dddddd/fff?text=1" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
    <h4>Print Color</h4>
    <span class="text-muted">teste</span>
  </div>
  <div class="col-6 col-sm-3 placeholder text-center">
    <img src="//placehold.it/200/e4e4e4/fff?text=2" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
    <h4>Print BW</h4>
    <span class="text-muted">teste</span>
  </div>
  <div class="col-6 col-sm-3 placeholder text-center">
    <img src="//placehold.it/200/d6d6d6/fff?text=3" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
    <h4>Users</h4>
    <span class="text-muted">teste</span>
  </div>
  <div class="col-6 col-sm-3 placeholder text-center">
    <img src="//placehold.it/200/e0e0e0/fff?text=4" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
    <h4>Total Print</h4>
    <span class="text-muted">teste</span>
  </div>
</div>


  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Type', 'Black/White'],
                ['Black/White',{{$printwithoutcolorpercent}}],
                ['Color',{{$printwithcolorpercent}}],
            ]);

            var options = {
                title: 'Number Of Prints By Type'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
  </head>
  <body>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>

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
          <td>{{$totalNumberOfPrints}}</td>
        </tr>
        <tr>
          <td>Number Of Prints By Type</td>
          <td>Black/White - {{$printwithoutcolorpercent}}%     |     Color - {{$printwithcolorpercent}}%</td>
        </tr>
        <tr>
          <td>Today's Number of Prints</td>
          <td>{{$todaysPrints}}</td>
        </tr>
        <tr>
          <td>Daily average of prints for the current month</td>
          <td>##</td>
        </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection
