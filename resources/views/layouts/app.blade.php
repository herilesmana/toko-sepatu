<x-templates.base>

    <x-slot name="title">
        @yield('title', '') 5R System
    </x-slot>

    <x-slot name="longName">5R System</x-slot>
    <x-slot name="shortName">5R</x-slot>

    @yield('content')

    <x-slot name="styles">
        @stack('styles')
    </x-slot>

    <x-slot name="scripts">
        @stack('scripts')
    </x-slot>
</x-templates.base>