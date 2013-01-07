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
          <a class="brand" href="/rms/account">CSE Revue - RMS</a>
          <div class="nav-collapse collapse">
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      @if(Session::get('success'))
      <div class="alert alert-success">
        <h1>Success</h1>
        <p>{{Session::get('success')}}</p>
      </div>
      @endif

      @if(Session::get('warning'))
      <div class="alert alert-error">
        <h1>Warning</h1>
        <p>{{Session::get('warning')}}</p>
      </div>
      @endif

      @if(Session::get('status'))
        <div class="alert alert-notice">
          <h1>Notice</h1>
          <p>{{Session::get('status')}}</p>
        </div>
      @endif

      @yield('extra_notice')

      <div class="hero-unit">
        <h1>CSE Revue - RMS</h1>
        <p>This is the Revue members site</p>
      </div>
      

      <!-- Example row of columns -->
<div class="row-fluid">
    
  <div class="span12">
    <div class="well">
    @yield('content')
    </div>
  </div>
</div>
      <hr>

      <footer>
        <p>&copy; CSE Revue, Designed and Developed By Christopher Manouvrier</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>



