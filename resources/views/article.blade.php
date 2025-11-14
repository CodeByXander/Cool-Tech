<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Use the article title for the page title -->
  <title>{{ $article->title }}</title>
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

    <!-- Article Title -->
    <h1>{{ $article->title }}</h1>

    <!-- Article metadata -->
    <p><strong>Published:</strong> {{ $article->created_at }}</p>

    <!-- Article Category (clickable link to category page) -->
    <p><strong>Category:</strong>
      <a href="/category/{{ $category->slug }}">{{ $category->name }}</a>
    </p>

    <!-- Article Tags (clickable links to tag pages) -->
    <p><strong>Tags:</strong>
      @foreach($tags as $tag)
      <a href="/tag/{{ $tag->slug }}">{{ $tag->name }}</a>
      <!-- Add a separator "|" between tags, except after the last one -->
      @if (!$loop->last) | @endif
      @endforeach
    </p>

    <hr>

    <!-- Article content -->
    <p>{{ $article->content }}</p>
  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>