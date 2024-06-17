<!DOCTYPE html>
<html lang="fr">

<head>
    @include('templates.partials._head')
    @include('templates.partials._header')
</head>

<body
    class="bg-gradient-to-r from-gray-800 via-blue-200 to-blue-900 text-white font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    <div class="">
        @include('templates.partials._main')
        @yield('calender')
    </div>

    @include('templates.partials._footer')
    @stack('scripts')
</body>

</html>
