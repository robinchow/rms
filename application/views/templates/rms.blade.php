<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
        @section('title')
            CSE Revue - RMS
        @yield_section
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    {{HTML::style('css/rms.css')}}
    {{Asset::container('bootstrapper')->styles()}}
    {{Asset::container('bootstrapper')->scripts()}}
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="/rms/account">account</a></li>
              <li><a href="/rms/years">years</a></li>
              <li><a href="/rms/teams">teams</a></li>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>CSE Revue - RMS</h1>
        <p>This is the Revue members site</p>
      </div>

      <!-- Example row of columns -->
      <div class="row-fluid">
            @yield('content')
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>



