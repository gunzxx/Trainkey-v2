<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title." - " }}TrainKey</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    @yield('css')
</head>

<body>
    <!-- Navbar -->
    <div class="nav">
        <a href="/" class="brand">
            <img src="/img/logo.png" alt="" width="70px">
            <h1>Train Key</h1>
        </a>
        <div class="sub-nav">
            {{-- <a class="nav-list">
                <p>Help & Support</p>
            </a>
            <a class="nav-list">
                <p>Documentation</p>
            </a> --}}
        </div>
    </div>
    <!-- End Navbar -->

    @yield('content')

    <script src="/js/script.js"></script>
</body>

</html>
