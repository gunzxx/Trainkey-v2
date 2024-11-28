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
    @yield('content')
    
    <script src="/js/jquery.min.js"></script>
    @yield('js')
</body>

</html>
