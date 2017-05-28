<! DOCTYPE html>

<html lang="en">

<head>
  <title>Completion Email</title>

</head>

<body>


  <h1>We are pleased to inform that your request, with the description "{{$request->description}}", has been printed.</h1>

  <p>
      You can check it <a href='{{url("list/{$request->id}")}}'> here.</a>
  </p>

</body>

</html>
