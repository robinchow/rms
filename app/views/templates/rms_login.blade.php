<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
        @section('title')
            CSE Revue - RMS
        @show
    </title>
    <link rel="icon" type="image/ico" href="/img/favicon32.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    {{HTML::style('bundles/bootstrapper/css/bootstrap.min.css')}}
    {{HTML::style('bundles/bootstrapper/css/bootstrap-responsive.min.css')}}
    {{HTML::style('bundles/bootstrapper/css/nav-fix.css')}}

    {{HTML::script('bundles/bootstrapper/js/jquery-1.8.3.min.js')}}
    {{HTML::script('bundles/bootstrapper/js/bootstrap.min.js')}}


    {{HTML::style('css/rms.css')}}
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
          <a class="brand" href="/">CSE Revue</a><a class="brand" href="/"> - </a><a class="brand" href="/rms/account/">RMS</a>
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

      @if($errors->has())
        <div class="alert alert-error">
          <h1>Errors</h1>
          <p>Please correct the following errors before submitting</p>
          <ul>
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
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
        <p>&copy; CSE Revue, Designed and Developed By Christopher Manouvrier, Stephen Sherratt and Maddison Joyce.</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>



