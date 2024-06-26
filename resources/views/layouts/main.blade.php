<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" sizes="16x16">
  <title>MyStock</title>

</head>
<body class="min-h-screen bg-base-200">
@include('partials.navbar')

<div class="lg:flex ">
    <div class="hidden lg:block sidebar">
        <aside id="sidebar" class=" fixed z-20 h-full top-0 bottom-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-300" aria-label="Sidebar">
            @include('partials.sidebar')
        </aside>
    </div>

    <div id="main-content" class="h-full w-full  relative overflow-y-auto lg:ml-64">
        <main>
            @yield('container')
        </main>
    </div>

    </div>

</div>
@yield('modal')

<script src="{{ asset('js/index.js') }}"></script>
{{-- AOS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
{{-- CHARJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- THEME CHANGE --}}
<script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>
