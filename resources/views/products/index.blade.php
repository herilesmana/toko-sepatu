<x-app-layout>
    <x-slot name="header">Products</x-slot>
    <x-slot name="activeMenu">products</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr class="table-light">
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->getFormattedPriceAttribute() }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    {{-- If the products table is empty, display a message --}}
                    @if ($products->isEmpty())
                        <tr>
                            <td class="text-center" colspan="6">No products found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
