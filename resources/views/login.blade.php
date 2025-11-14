<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Login - Cool Tech</title>
</head>

<body>

  <!-- Include the cookie notice component -->
  @include('components.cookies')

  <div class="content-wrapper">

    <!-- Login Form -->
    <form action="/login" method="post">
      <!-- CSRF token for security (prevents cross-site request forgery attacks) -->
      @csrf

      <!-- Email input field -->
      <input type="email" name="email" placeholder="Email" required><br>

      <!-- Password input field -->
      <input type="password" name="password" placeholder="Password" required><br>

      <!-- Submit button -->
      <button type="submit">Login</button>
    </form>

    <!-- Link to registration page for new users -->
    <a href="/register">Don't have an account? Register</a>

  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>