<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Admin Console - Cool Tech</title>
</head>

<body>

  <!-- Include the cookie notice component -->
  @include('components.cookies')

  <!-- Include the site-wide navigation header -->
  @include('components.header')

  <div class="content-wrapper">
    <!-- Page main heading -->
    <h1>Admin Console</h1>

    <!-- Create Category Form -->
    <form action="/admin" method="post">
      @csrf <!-- CSRF token to protect against cross-site request forgery -->

      <h2>Create Category</h2>
      <!-- Hidden input tells the server which action to perform -->
      <input type="hidden" name="action" value="create_category">
      <!-- Input for the new category name -->
      <input type="text" name="category_name" placeholder="New category name">
      <button type="submit">Create</button>
    </form>

    <hr>

    <!-- Rename Category Form -->
    <form action="/admin" method="post">
      @csrf

      <h2>Rename Category</h2>
      <!-- Hidden input tells the server this is a rename action -->
      <input type="hidden" name="action" value="rename_category">

      <!-- Dropdown to select which category to rename -->
      <select name="category_id">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>

      <!-- Input for the new category name -->
      <input type="text" name="new_name" placeholder="New name">
      <button type="submit">Rename</button>
    </form>

    <hr>

    <!-- Delete Article Form -->
    <form action="/admin" method="post">
      @csrf

      <h2>Delete Article</h2>
      <!-- Hidden input tells the server this is a delete article action -->
      <input type="hidden" name="action" value="delete_article">

      <!-- Dropdown to select which article to delete -->
      <select name="article_id">
        @foreach ($articles as $article)
        <option value="{{ $article->id }}">{{ $article->title }}</option>
        @endforeach
      </select>
      <button type="submit">Delete</button>
    </form>
  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>