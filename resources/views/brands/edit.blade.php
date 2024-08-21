<x-app-layout>
    <x-slot name="header">Edit Merk</x-slot>
    <x-slot name="activeMenu">master-merk</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label">Nama Merk:</label>
                    <input type="text" name="name" id="name" value="{{ $brand->name }}" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Keterangan:</label>
                    <textarea name="description" id="description" class="form-control">{{ $brand->description }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
