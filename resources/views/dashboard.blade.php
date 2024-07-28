<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Selamat datang di aplikasi toko sepatu <strong>Glory Shoes</strong></h1>
                </div>
            </div>

            <h2 class="mt-8 mb-3 text-xl font-semibold">Summary Master</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Products</h2>
                    <p class="mt-2 text-3xl">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Brands</h2>
                    <p class="mt-2 text-3xl">{{ $totalBrands }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Categories</h2>
                    <p class="mt-2 text-3xl">{{ $totalCategories }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Shoe Sizes</h2>
                    <p class="mt-2 text-3xl">{{ $totalShoeSizes }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Stocks</h2>
                    <p class="mt-2 text-3xl">{{ $totalStocks }}</p>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
