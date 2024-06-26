<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Canteen Fasilkom</title>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- General CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Specific CSS --}}
    @stack('css')
    <style>
        body {
            background-image: url({{ asset('images/img/background.png') }});
        }
    </style>
</head>

<body>
    @include('partials/navbar')

    @yield('container')

    @include('partials/footer')

    @stack('js')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uid = localStorage.getItem('uid');
            if (uid) {
                const cekPesananLink = document.getElementById('cekPesananLink');
                cekPesananLink.href = `/cekPesanan/${uid}`;
            }
        });

        // Cek apakah saat ini tidak di halaman 'Menu'
        if (!window.location.pathname.includes('/menu')) {
            resetMenuFilters();
        }

        // Fungsi untuk reset filter
        function resetMenuFilters() {
        localStorage.setItem('selectedCategory', 'Semua Kategori');
        localStorage.setItem('selectedTenant', 'Semua Outlet');
        const categoryLabel = document.getElementById('label-category');
        const tenantLabel = document.getElementById('label-tenant');
        if (categoryLabel && tenantLabel) {
            categoryLabel.textContent = 'Semua Kategori';
            tenantLabel.textContent = 'Semua Outlet';
            }
        }
    </script>
</body>

</html>
