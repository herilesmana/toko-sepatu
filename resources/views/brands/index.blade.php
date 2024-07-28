<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('brands.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Brand</a>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-yellow-500 bg-opacity-50 text-black">
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Description</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr class="hover:bg-slate-50">
                                    <td class="border px-4 py-2">{{ $brand->name }}</td>
                                    <td class="border px-4 py-2">{{ $brand->description }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- If the brands table is empty, display a message to the user. --}}
                            @if ($brands->isEmpty())
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="3">No brands found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
