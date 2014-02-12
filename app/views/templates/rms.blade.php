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
    <link rel="icon" type="image/ico" href="/img/favicon32.ico">
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
            <form class="navbar-form pull-right">
              <a href="/rms/account/logout" class="btn">Logout</a>
            </form>
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
  <div class="span3">
    <div class="well sidebar-nav">
    <ul class="nav nav-list">
    <li class="nav-header">My Account</li>
    @if(Auth::user()->needs_to_renew)
    <li>{{HTML::link('rms/account/renew','Renew')}}</li>
    @endif
    <li>{{HTML::link('rms/account','Profile')}}</li>
    <li>{{HTML::link('rms/account/edit','Edit Profile')}}</li>
    <li>{{HTML::link('rms/account/change-password','Change Password')}}</li>
    <li>{{HTML::link('rms/account/change-email','Change Email')}}</li>

    <li class="nav-header">Teams</li>
    <li>{{HTML::link('rms/teams','View Teams')}}</li>
    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
        <li>{{HTML::link('rms/teams/renew','Renew Teams')}}</li>
    @endif

    <li class="nav-header">Years</li>
    <li>{{HTML::link('rms/years','View Years')}}</li>

    <li class="nav-header">Members</li>
    <li>{{HTML::link('rms/users/search', 'Search Members')}}</li>

    <li class="nav-header">Executives</li>
    <li>{{HTML::link('rms/executives','View Executives')}}</li>
</li>
    
    <li class="nav-header">Camp</li>
    @if(Year::current_year()->camp_active())
      @if(Auth::user()->has_signed_up_for_camp()) 
      <li>{{HTML::link('rms/camp/registrations/edit','Update ')}}</li>
      @else
      <li>{{HTML::link('rms/camp/registrations/signup','Sign Up')}}</li>
      @endif
    @else
      <li>Not open yet</li>
    @endif

    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
      <li>{{HTML::link('rms/camp/settings','Settings')}}</li>
      <li>{{HTML::link('rms/camp/registrations','Registrations')}}</li>

    @endif


    <li class="nav-header">Merch</li>
      <li>{{HTML::link('rms/merch/orders/','My Orders ')}}</li>
      <li>{{HTML::link('rms/merch/orders/new','Order Merch')}}</li>

    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
      <li>{{HTML::link('rms/merch/items','Items')}}</li>
      <li>{{HTML::link('rms/merch/orders/admin','All Orders')}}</li>

    @endif

    <li class="nav-header">Wellbeing</li>
      <li>{{HTML::link('rms/wellbeing/orders/','My Order')}}</li>

    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
      <li>{{HTML::link('rms/wellbeing/nights','Nights')}}</li>
      <li>{{HTML::link('rms/wellbeing/orders/admin','All Orders')}}</li>

    @endif



    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
      <li class="nav-header">Website Settings</li>
      <li>{{HTML::link('rms/news','News')}}</li>
      <li>{{HTML::link('rms/blog','Blog')}}</li>
      <li>{{HTML::link('rms/faqs','FAQs')}}</li>
      <li>{{HTML::link('rms/sponsors','Sponsors')}}</li>
      @if(Auth::user()->admin)
        <li>{{HTML::link('rms/years','Years')}}</li>
      @endif
    @else
      <li class="nav-header">User Content</li>
      <li>{{HTML::link('rms/news','News')}}</li>
      <li>{{HTML::link('rms/blog/posts','Blog')}}</li>
    @endif




    </ul>

    </div>
  </div>
  <div class="span9">
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



