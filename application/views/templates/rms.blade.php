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
    <header>
      <h1>
        CSE Revue - RMS
      </h1>
      <nav>
        <ul class="menu">
          <li>{{HTML::link('rms/account/','My Account')}}</li>
          <li>{{HTML::link('rms/teams/','Teams')}}</li>
          <li>{{HTML::link('rms/years/','Years')}}</li>
        </ul>
      </nav>
    </header>
    @yield('content')
    <footer>

    </footer>

  </body>
</html>