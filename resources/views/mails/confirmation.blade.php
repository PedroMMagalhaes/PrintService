<! DOCTYPE html>

<html lang="en">

<head>
  <title>Confirmation Email</title>

</head>

<body>


  <h1>Thanks for Sign Up</h1>

  <p>
      You need to <a href='{{url("register/confirm/{$user->remember_token}")}}'> confirm your email address</a>
  </p>

</body>

</html>
