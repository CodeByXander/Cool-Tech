<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Register - Cool Tech</title>
</head>

<body>

  <!-- Include the cookie notice component -->
  @include('components.cookies')

  <div class="content-wrapper">

    <!-- Registration Form -->
    <form action="/register" method="post">
      <!-- CSRF token for security -->
      @csrf

      <!-- Name input field -->
      <input type="text" name="name" placeholder="Full Name" required><br>

      <!-- Email input field -->
      <input type="email" name="email" placeholder="Email" required><br>

      <!-- Password input field -->
      <input type="password" name="password" placeholder="Password" required><br>

      <!-- Submit button -->
      <button type="submit">Register</button>
    </form>

    <!-- Link to login page for users who already have an account -->
    <a href="/login">Already have an account? Login</a>

  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>