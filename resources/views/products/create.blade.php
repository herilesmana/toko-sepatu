<x-app-layout>
    <x-slot name="header">Tambah Sepatu</x-slot>
    <x-slot name="activeMenu">master-sepatu</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Nama Sepatu:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Keterangan:</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="form-label">Harga:</label>
                    <input type="number" name="price" id="price" step="0.01" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="brand_id" class="form-label">Merk:</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="">Pilih</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="form-label">Jenis:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Pilih</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
