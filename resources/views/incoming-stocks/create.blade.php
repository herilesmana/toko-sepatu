<x-app-layout>
    <x-slot name="header">Barang Masuk</x-slot>
    <x-slot name="activeMenu">barang-masuk</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('incoming-stocks.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="product_id" class="form-label">Nama Sepatu</label>
                    <select name="product_id" id="product_id" class="form-select" required>
                        <option value="">Pilih</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="shoe_size_id" class="form-label">Ukuran Sepatu</label>
                    <select name="shoe_size_id" id="shoe_size_id" class="form-select" required>
                        <option value="">Pilih</option>
                        @foreach($shoeSizes as $shoeSize)
                            <option value="{{ $shoeSize->id }}">{{ $shoeSize->size }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('incoming-stocks.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
