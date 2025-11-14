<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the main CSS file -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <title>Legal - Cool Tech</title>
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
    <h1>Legal Information</h1>

    <!-- Terms of Use Section -->
    <h2>Terms of Use</h2>
    <p>Welcome to Cool Tech. By accessing and using our website, you agree to comply with these Terms of Use. If you do not agree, please refrain from using our website.</p>
    <p>The content provided on this website is for informational purposes only. We make every effort to ensure the accuracy of the information, but we cannot guarantee that all information is correct, complete, or up-to-date. Cool Tech is not responsible for any errors or omissions.</p>
    <p>Users may not copy, reproduce, distribute, or republish content from this site without written permission from Cool Tech. All intellectual property, including text, images, graphics, and logos, remains the property of Cool Tech or its content providers.</p>

    <!-- Privacy Policy Section -->
    <h2>Privacy Policy</h2>
    <p>Cool Tech respects your privacy. Any personal information collected through forms, subscriptions, or comments will be used solely for the purposes stated at the point of collection.</p>
    <p>We may collect basic data such as your email address for newsletters or to respond to inquiries. We do not sell or share personal information with third parties for marketing purposes. However, we may share anonymized data for analytics to improve our website and content.</p>
    <p>Our website uses cookies to enhance user experience, track visitor behavior, and for functional purposes. By using our site, you consent to the use of cookies in accordance with this policy. You may disable cookies in your browser, but some features of the site may not function correctly.</p>

    <!-- Disclaimers Section -->
    <h2>Disclaimers</h2>
    <p>Articles and opinions expressed on Cool Tech are for general informational purposes. The website does not provide professional advice and should not be relied upon as a substitute for advice from a qualified professional.</p>
    <p>Cool Tech is not liable for any damages arising from the use of the website, including direct, indirect, incidental, or consequential damages. Users are responsible for how they use the information provided.</p>
    <p>We reserve the right to update these Terms of Use and Privacy Policy at any time without prior notice. Updated versions will be posted on this page, and continued use of the website constitutes acceptance of the revised terms.</p>

  </div>

  <!-- Include the site-wide footer component -->
  @include('components.footer')

</body>

</html>