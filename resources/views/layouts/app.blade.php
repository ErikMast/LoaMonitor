<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

<!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (!Auth::guest())
							          <li>
                                <a href="{{ url('/students') }}">
                                    Studenten
                                </a>
							          </li>

							          <!--li>
										              <a href="{{ url('/users') }}">Gebruikers</a>
							          </li -->
                        <ul class= "nav navbar-nav navbar-left">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  Overzichten <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                <li>
                                  <a href="{{ url('/sbustats') }}">
                                      SBU voortgang
                                  </a>
                                </li>
                              </ul>
        					          </li>
                        </ul>

                        <ul class= "nav navbar-nav navbar-right">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  Beheer <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                <li>
								                   <a href="/users">Gebruikers</a>
                                </li>
                                <li>
								                   <a href="/modules">Modules</a>
                                </li>
                                <li>
                                   <a href="/groups">Klassen</a>
                                </li>
                                <li>
                                   <a href="/movestudents">Studenten verhuizen (klas)</a>
                                </li>
                                <li>
        								           <a href="/csvdata">Studenten Importeren</a>
                					      </li>
                              </ul>
        					          </li>
                        </ul>

						            @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Auth::guest())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->firstname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
								                  <li>
                                    <a href="{{ route('changepassword') }}">
                                            Change Password
                                    </a>
                                  </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
