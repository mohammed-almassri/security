<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ursa-purejs@0.0.3/lib/ursa.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="vertical-nav bg-white" id="sidebar">
            <div class="py-4 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center">
                    <img src="{{ asset('123.jpg') }}" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                    <div class="media-body">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <h4 class="m-0 username">{{ Auth::user()->name }}</h4> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <p class="font-weight-light text-muted mb-0">Web developer</p>
                    </div>
                </div>
            </div>

            <p class="text-gray font-weight-bold text-uppercase px-3 small pb-2 mb-0">Main</p>

            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('messages.create')}}" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Create A New Message
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('messages.index')}}" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        View All Messages
                    </a>
                </li>
            </ul>

            <p class="text-gray font-weight-bold text-uppercase px-3 small pb-0 mt-5">About</p>

            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Mohammed M. Al M'ass'ry
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Abdelrahman Y. Lulu
                    </a>
                </li>
            </ul>
        </div>

        <main class="py-4">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
            @yield('content')
        </main>
    </div>
    <script>
        function encrypt(message, key) {
            var encrypted = CryptoJS.AES.encrypt(JSON.stringify(message), key);
            return encrypted;
        }

        function decrypt(message, key) {
            var decrypted = CryptoJS.AES.decrypt(message, key);
            decrypted = decrypted.toString(CryptoJS.enc.Utf8);
            return JSON.parse(decrypted);
        }
    </script>
    @yield('js')
</body>

</html>