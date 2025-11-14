<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Writer Console - Cool Tech</title>
</head>

<body>

  <!-- Include cookie notice component -->
  @include('components.cookies')

  <!-- Include site-wide header/navigation -->
  @include('components.header')

  <div class="content-wrapper">

    <!-- Page heading -->
    <h1>Writer Console</h1>

    <!-- Form to add a new article -->
    <form action="/writer" method="post">
      @csrf <!-- CSRF token for security -->

      <!-- Article Title -->
      <label>Title:</label><br>
      <input type="text" name="title" required><br><br>

      <!-- Article Content -->
      <label>Content:</label><br>
      <textarea name="content" rows="10" cols="50" required></textarea><br><br>

      <!-- Category ID -->
      <label>Category ID:</label><br>
      <input type="number" name="category_id" required><br><br>

      <!-- Tags input (comma-separated) -->
      <label>Tags (comma-separated):</label><br>
      <input type="text" name="tags"><br><br>

      <!-- Submit button -->
      <button type="submit">Add Article</button>
    </form>

  </div>

  <!-- Include site-wide footer component -->
  @include('components.footer')
</body>

</html>