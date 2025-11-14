<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Search - Cool Tech</title>
</head>

<body>

  <!-- Include the cookie notice component -->
  @include('components.cookies')

  <!-- Include the site-wide navigation header -->
  @include('components.header')

  <div class="content-wrapper">

    <!-- Login Status -->
    <div style="text-align:right; margin-bottom:10px;">
      @if(session('user_name'))
      <!-- Show username and logout link if user is logged in -->
      Welcome, {{ session('user_name') }} | <a href="/logout">Logout</a>
      @else
      <!-- Show login/register links if not logged in -->
      <a href="/login">Login</a> | <a href="/register">Register</a>
      @endif
    </div>

    <!-- Page heading -->
    <h1>Search Cool Tech</h1>

    <!-- Search by Article ID -->
    <form action="/search/result" method="get">
      <label>Search by Article ID:</label>
      <input type="number" name="id" placeholder="Enter article ID">
      <button type="submit">Search</button>
    </form>

    <!-- Search by Category slug -->
    <form action="/search/result" method="get">
      <label>Search by Category:</label>
      <input type="text" name="category" placeholder="Enter category slug">
      <button type="submit">Search</button>
    </form>

    <!-- Search by Tag slug -->
    <form action="/search/result" method="get">
      <label>Search by Tag:</label>
      <input type="text" name="tag" placeholder="Enter tag slug">
      <button type="submit">Search</button>
    </form>

  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>