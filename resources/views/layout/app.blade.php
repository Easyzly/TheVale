<!doctype html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body style="background-size: cover; background-position: center; background-image: url('{{ asset('images/vale.jpg') }}');">
    <div class="backdrop-blur-lg grid h-screen place-items-center">
        @yield('content')
    </div>
</body>
</html>
