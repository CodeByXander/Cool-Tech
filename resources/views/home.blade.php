<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Cool Tech - Home</title>
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
      <!-- Show username and logout if user is logged in -->
      Welcome, {{ session('user_name') }} | <a href="/logout">Logout</a>
      @else
      <!-- Show login/register links if not logged in -->
      <a href="/login">Login</a> | <a href="/register">Register</a>
      @endif
    </div>

    <!-- Main page heading -->
    <h1>Latest Articles</h1>

    <!-- Loop through the latest 5 articles -->
    @foreach ($articles as $article)
    <!-- Article title as a clickable link -->
    <h2>
      <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
    </h2>

    <!-- Display a short preview of the article content (first 200 characters) -->
    <p>{{ Str::limit($article->content, 200) }}</p>
    <hr>
    @endforeach

  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>