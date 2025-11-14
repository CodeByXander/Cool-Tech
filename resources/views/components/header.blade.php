<nav style="background:#f6f2eb; padding:10px;">
  <a href="/" style="margin-right:15px;">Home</a>
  <a href="/about" style="margin-right:15px;">About Us</a>

  @if(session('user_name'))
  @if(session('user_role') === 'writer' || session('user_role') === 'admin')
  <a href="/writer" style="margin-right:15px;">Writer Console</a>
  @endif

  @if(session('user_role') === 'admin')
  <a href="/admin" style="margin-right:15px;">Admin Console</a>
  @endif
  @endif
</nav>
<hr>