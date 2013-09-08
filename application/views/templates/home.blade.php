<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
        @section('title')
            CSE Revue
        @yield_section
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    {{Asset::container('bootstrapper')->styles()}}
    {{Asset::container('bootstrapper')->scripts()}}

    {{HTML::style('css/home.css')}}
    <link href='http://fonts.googleapis.com/css?family=Cantarell:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/ico" href="/img/favicon32.ico">
  </head>

  <body>

  <div style="position:fixed;top:0px;left:0px;padding:10px;border:3px solid #0BB5FF;background-color:black;font-size:24px">
    <a href="http://infringers.com.au/bookings">Buy Tickets!</a>
  </div>

  <div class="container">
     <div class="row">
      <header>
        <img src="/img/logo.png"><h1>CSE Revue</h1>
      </header>
      <ul class="accounts">
        <li><a href="/rms/account/signup">Sign Up</a></li> - 
        <li>
          @if(Auth::guest())
            <a href="/rms/account/login">Login</a>
          @else
            <a href="/rms">RMS</a>
          @endif
        </li>
      </ul>
     </div>

    <div class="row">
      <div class="span10 offset1">
        <nav id="main-menu">
          <ul class="nav nav-pills">
            <li><a href="/home">Home</a></li>
            <li><a href="/home/sponsors">Sponsors</a></li>
            <li><a href="/home/exec">Exec</a></li>
            <li><a href="/home/faqs">FAQ</a></li>
            <li><a href="/home/history">History</a></li>
            <li><a href="/home/teams">Teams</a></li>
            <li><a href="http://www.youtube.com/user/cserevue">Youtube</a></li>
          </ul>
        </nav>
    </div>
  </div>

    @yield('content')


    <div class="row">
      <footer>
        <p>&copy; CSE Revue. Designed and Developed By Christopher Manouvrier, Stephen Sherratt and Maddison Joyce.</p>
      </footer>
    </div>
  </div>
  </body>
</html>



