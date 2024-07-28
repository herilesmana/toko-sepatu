<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Product</a>
                    </div>
                    <table class="min-w-full mt-4">
                        <thead>
                            {{-- // Style the table header with yellow theme --}}
                            <tr class="bg-yellow-500 bg-opacity-50 text-black">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Brand</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="hover:bg-slate-50">
                                    <td class="border px-4 py-2">{{ $product->name }}</td>
                                    <td class="border px-4 py-2">{{ $product->description }}</td>
                                    <td class="border px-4 py-2">{{ $product->getFormattedPriceAttribute() }}</td>
                                    <td class="border px-4 py-2">{{ $product->brand->name }}</td>
                                    <td class="border px-4 py-2">{{ $product->category->name }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex gap-1">
                                            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- If the product is empty --}}
                            @if ($products->isEmpty())
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="6">No products found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- // Pagination --}}
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
