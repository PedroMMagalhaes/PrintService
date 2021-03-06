<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="utf-8">
    <title>PrintIT</title>
    <meta name="description" content="Projeto de Ainet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/sidebar.css') }}"/>

</head>


<body>
@include ('layout.nav')


@include('layout.sidebar')

<!--<body>-->

@include('layout.flash')

@yield('content')

@include ('layout.footer')


<!--scripts-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<script src="/js/app.js"></script>
@yield('scripts')

</body>
</html>
