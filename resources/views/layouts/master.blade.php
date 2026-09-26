<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Đông Bắc Nông Nghiệp & Cá Tầm')</title>
    <meta name="description" content="@yield('meta_description', 'Chuyên cung cấp cá tầm và các sản phẩm nông nghiệp sạch từ trang trại VietGAP')">
    <meta name="keywords" content="@yield('meta_keywords', 'Cá tầm, nông sản, nông nghiệp, Đông Bắc')">
    @if(setting('site.logo'))
    <link rel="icon" href="{{ Voyager::image(setting('site.logo')) }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            DEFAULT: '#1B4332',
                            light: '#2D6A4F',
                            dark: '#081C15',
                            accent: '#40916C',
                            bg: '#F8FAF9'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .clip-path-farm {
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

    @if(!request()->routeIs('login') && !request()->routeIs('register'))
        @include('partials.header')
    @endif

    @yield('content')

    @if(!request()->routeIs('login') && !request()->routeIs('register'))
        @include('partials.footer')
    @endif

    @stack('scripts')
</body>
</html>
