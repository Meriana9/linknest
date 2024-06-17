<div class="container mx-auto flex flex-col md:flex-row pt-4 pb-12 text-white">
    @if (!View::hasSection('hideAside'))
        @include('templates.partials._aside')
    @endif
    <main class="w-full md:w-3/4 lg:w-2/3 mx-auto p-3 pt-20">
        @yield('content')
    </main>
</div>
