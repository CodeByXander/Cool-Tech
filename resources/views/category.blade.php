<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Use the category name for the page title -->
  <title>{{ $category->name }}</title>
</head>

<body>

  <!-- Include the cookie notice component -->
  @include('components.cookies')

  <!-- Include the site-wide navigation header -->
  @include('components.header')

  <div class="content-wrapper">

    <!-- Login Status (shows username/logout if logged in, login/register if not) -->
    <div style="text-align:right; margin-bottom:10px;">
      @if(session('user_name'))
      Welcome, {{ session('user_name') }} | <a href="/logout">Logout</a>
      @else
      <a href="/login">Login</a> | <a href="/register">Register</a>
      @endif
    </div>

    <!-- Page heading showing the category -->
    <h1>Category: {{ $category->name }}</h1>

    <!-- Check if there are any articles in this category -->
    @if (count($articles) === 0)
    <p>No articles in this category yet.</p>
    @else
    <!-- Loop through all articles in the category -->
    @foreach ($articles as $article)
    <!-- Article title as a clickable link -->
    <h2>
      <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
    </h2>

    <!-- Display a shortened version of the article content (first 200 characters) -->
    <p>{{ Str::limit($article->content, 200) }}</p>
    <hr>
    @endforeach
    @endif
  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>