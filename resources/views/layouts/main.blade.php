<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title." - " : '' }}TrainKey</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/sw2/sweetalert2.min.css">
    <script src="/sw2/sweetalert2.min.js"></script>
    @yield('css')
</head>

<body>
    <!-- Navbar -->
    <nav class="nav">
        <a href="/" class="brand">
            <img src="img/logo.png" alt="" width="70px">
            <h1>TrainKey</h1>
        </a>
        <div class="sub-nav">
            <a class="nav-list" href="forum" target="_blank">
                <p>Forum</p>
            </a>
            {{-- <a class="nav-list">
                <p>Help & Support</p>
            </a>
            <a class="nav-list">
                <p>Documentation</p>
            </a> --}}
        </div>
        <div class="profile-container">
            <img src="{{ auth()->user()->getFirstMediaUrl('profile') == "" ? "/img/profile/default.png" : auth()->user()->getFirstMediaUrl('profile') }}" alt="" class="profile" id="profile">
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="profile-menu" id="profile-menu">
        <a class="menu" href="/profile">Edit profile</a>
        <a class="menu" href="/password">Ganti password</a>
        <a class="menu" id="logoutBtn" style="cursor: pointer;">Logout</a>
    </div>

    @yield('content')
    
    <script src="/js/jquery.min.js"></script>
    <script src="/js/script.js"></script>
    @yield('js')
</body>

</html>
