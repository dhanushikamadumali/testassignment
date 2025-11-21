
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- notify css --}}
    @notifyCss
    <title>Chat App</title>
    
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    {{-- css --}}
    @include('layouts.css')
    
    
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-notify::notify />
    
    <div class="container-fluid" style="background-color:white">
        <div class="row" >
            {{-- LEFT SIDEBAR --}}
            <div class="col-md-3 col-lg-2 bg-light border-end min-vh-100 p-3">
                 @include('layouts.main.sidebar')
            </div>

             <div class="col-md-9 col-lg-10 p-4">
            {{-- nav bar --}}
              <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                  <div class="container">
             
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                          <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <!-- Left Side Of Navbar -->
                          <ul class="navbar-nav me-auto">

                          </ul>

                          <!-- Right Side Of Navbar -->
                          <ul class="navbar-nav ms-auto">
                              <!-- Authentication Links -->
                              @guest
                                  @if (Route::has('login'))
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                      </li>
                                  @endif

                                  @if (Route::has('register'))
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                      </li>
                                  @endif
                              @else
                                  <li class="nav-item dropdown">
                                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                          {{ Auth::user()->name }}
                                      </a>

                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                           document.getElementById('logout-form').submit();">
                                              {{ __('Logout') }}
                                          </a>

                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                              @csrf
                                          </form>
                                      </div>
                                  </li>
                              @endguest
                          </ul>
                      </div>
                  </div>
              </nav>
                 {{-- content --}}
                @yield('content')
            </div>
           
            
        </div>
        
    </div>
    
    {{-- js --}}
    @include('layouts.main.script')
    {{-- notify js --}}
    @notifyJs
</body>
</html>
