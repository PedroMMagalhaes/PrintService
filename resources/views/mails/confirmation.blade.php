<! DOCTYPE html>

<html lang="en">

<head>
  <title>Confirmation Email</title>

</head>

<body>


  <h1>Thanks for Sign Up</h1>

  <p>
      You need to <a href='{{ url("user/confirm/{user->token}") }}'> confirm your email address</a>
  </p>

</body>

</html>
