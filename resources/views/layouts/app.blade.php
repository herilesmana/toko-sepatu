<x-templates.base>

    <x-slot name="title">
        @yield('title', '') Toko Sepatu
    </x-slot>

    <x-slot name="longName">Toko Sepatu</x-slot>
    <x-slot name="shortName">TS</x-slot>

    @yield('content')

    <x-slot name="styles">
        @stack('styles')
    </x-slot>

    <x-slot name="scripts">
        @stack('scripts')
    </x-slot>
</x-templates.base>