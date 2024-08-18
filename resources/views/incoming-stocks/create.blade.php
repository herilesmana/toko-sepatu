<x-app-layout>
    <x-slot name="header">Add Incoming Stock</x-slot>
    <x-slot name="activeMenu">incoming-stocks</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('incoming-stocks.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="product_id" class="form-label">Product</label>
                    <select name="product_id" id="product_id" class="form-select" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="shoe_size_id" class="form-label">Shoe Size</label>
                    <select name="shoe_size_id" id="shoe_size_id" class="form-select" required>
                        @foreach($shoeSizes as $shoeSize)
                            <option value="{{ $shoeSize->id }}">{{ $shoeSize->size }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Add Stock</button>
                    <a href="{{ route('incoming-stocks.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
