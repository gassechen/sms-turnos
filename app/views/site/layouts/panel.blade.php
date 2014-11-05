<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

  <meta charset="UTF-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>
    @section('title')
      Turnos !
    @show
  </title>

  <meta name="keywords" content="@yield('keywords')" />
  <meta name="author" content="@yield('author')" />
  <!-- Google will often use this as its description of your page/site. Make it good. -->
  <meta name="description" content="@yield('description')" />

  <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
  <meta name="google-site-verification" content="">

  <!-- Dublin Core Metadata : http://dublincore.org/ -->
  <meta name="DC.title" content="Project Name">
  <meta name="DC.subject" content="@yield('description')">
  <meta name="DC.creator" content="@yield('author')">

  <!--  Mobile Viewport Fix -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- This is the traditional favicon.
   - size: 16x16 or 32x32
   - transparency is OK
   - see wikipedia for info on browser support: http://mky.be/favicon/ -->
  <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

  <!-- iOS favicons. -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
  <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

  <!-- CSS -->
    {{ Basset::show('admin.css') }}
    {{HTML::style('assets/css/sb-admin.css')}}
    
    {{HTML::style('assets/css/bootstrap-datetimepicker.css')}}
    {{HTML::style('assets/css/bootstrap-table.css')}}
    {{HTML::style('assets/css/jquery-ui.css')}}

  <style>
  body {
    padding: 60px 0;
  }
  </style>

  @yield('styles')

  

</head>

<body>
  <!-- Container -->
  <div class="container">
    <!-- Navbar -->
    <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav ">
                        @if (Auth::check())
                        <li><a href="{{{ URL::to('turns') }}}">Inicio</a></li>
                        <li><a href="{{{ URL::to('turns/create') }}}">Nuevo Turno</a></li>
                        <li><a href="{{{ URL::to('messages') }}}">Mensajes</a></li>
                        <li><a href="{{{ URL::to('contacts') }}}">Contactos</a></li>
                        
                </ul>       
                <ul class="nav navbar-nav pull-right">
                        
                        
                        @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                        @endif
                        <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
                        <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
                        @else
                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                        <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                      </ul>

              
          </div>
            </div>
    </div>
    <!-- ./ navbar -->

    <!-- Notifications -->
    @include('notifications')
    <!-- ./ notifications -->

    <!-- Content -->
    @yield('content')
    <!-- ./ content -->

    <!-- Footer -->
    <footer class="clearfix">
      @yield('footer')
    </footer>
    <!-- ./ Footer -->

  </div>
  <!-- ./ container -->

 
  <!-- Javascripts -->
    {{ HTML::script('assets/js/jquery.js') }}
    {{ Basset::show('admin.js') }}

    {{ HTML::script('assets/js/flot/jquery.flot.js') }}
    {{ HTML::script('assets/js/flot/jquery.flot.selection.js') }}
    {{ HTML::script('assets/js/flot/jquery.flot.navigate.js') }}
    {{ HTML::script('assets/js/flot/jquery.flot.time.js') }}
    {{ HTML::script('assets/js/flot/jquery.flot.canvas.js') }}

    {{ HTML::script('assets/js/bootstrap-datetimepicker.min.js') }}
      
    {{ HTML::script('assets/js/locales/bootstrap-datetimepicker.es.js') }}

    {{ HTML::script('assets/js/bootstrap-table.js') }}
    {{ HTML::script('assets/js/jquery.maskedinput.min.js') }}
    {{ HTML::script('assets/js/jquery.charactercounter.js') }}
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script type="text/javascript">
      $('.wysihtml5').wysihtml5();
        $(prettyPrint);
    </script>

    @yield('scripts')

</body>

</html>