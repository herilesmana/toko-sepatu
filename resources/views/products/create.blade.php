<x-app-layout>
    <x-slot name="header">Add Product</x-slot>
    <x-slot name="activeMenu">products</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" name="price" id="price" step="0.01" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="brand_id" class="form-label">Brand:</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="form-label">Category:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Add Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
