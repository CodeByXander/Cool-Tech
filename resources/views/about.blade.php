<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>About Us - Cool Tech</title>
</head>

<body>

  <!-- Include the cookie notice component -->
  @include('components.cookies')

  <!-- Include the site-wide navigation header -->
  @include('components.header')

  <div class="content-wrapper">

    <!-- Login Status (shows username and logout link if logged in, or login/register links if not) -->
    <div style="text-align:right; margin-bottom:10px;">
      @if(session('user_name'))
      Welcome, {{ session('user_name') }} | <a href="/logout">Logout</a>
      @else
      <a href="/login">Login</a> | <a href="/register">Register</a>
      @endif
    </div>

    <!-- Page main heading -->
    <h1>About Cool Tech</h1>

    <!-- Page content -->
    <p>Welcome to Cool Tech! We specialise in bringing digestible information about all things technology for popular consumption.</p>

    <p>Our mission is to make tech accessible, fun, and easy to understand. We cover the latest tech news, software reviews, hardware reviews, and opinion pieces.</p>

    <p>Our team of writers is growing rapidly, and we are always looking for passionate tech enthusiasts to contribute.</p>

  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>