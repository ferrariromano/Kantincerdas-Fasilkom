<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Canteen Fasilkom</title>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- General CSS -->
    <link rel="stylesheet" href="css/style.css">
    {{-- Specific CSS --}}
    @stack('css')
    <style> body {background-image: url({{ asset('images/img/background.png') }});}</style>
</head>

<body>
    @include('partials/navbar')

    <div class="container">
        @yield('container')
    </div>

    @include('partials/footer')
</body>

</html>