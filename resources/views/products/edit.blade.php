<x-app-layout>
    <x-slot name="header">Edit Product</x-slot>
    <x-slot name="activeMenu">products</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="brand_id" class="form-label">Brand:</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="form-label">Category:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Update Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
