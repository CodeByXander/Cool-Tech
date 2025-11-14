<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Page title dynamically set to the tag name -->
  <title>{{ $tag->name }}</title>
</head>

<body>

  <!-- Include cookie notice component -->
  @include('components.cookies')

  <!-- Include site-wide header/navigation -->
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

    <!-- Tag heading -->
    <h1>Tag: {{ $tag->name }}</h1>

    @if (count($articles) === 0)
    <!-- Display message if no articles exist for this tag -->
    <p>No articles with this tag yet.</p>
    @else
    <!-- Loop through articles associated with this tag -->
    @foreach ($articles as $article)
    <h2>
      <!-- Link to individual article page -->
      <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
    </h2>

    <!-- Show a short preview of the article content -->
    <p>{{ Str::limit($article->content, 200) }}</p>

    <hr>
    @endforeach
    @endif
  </div>

  <!-- Include site-wide footer component -->
  @include('components.footer')

</body>

</html>