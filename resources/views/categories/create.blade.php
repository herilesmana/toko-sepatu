<x-app-layout>
    <x-slot name="header">Tambah Jenis</x-slot>
    <x-slot name="activeMenu">master-jenis</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Nama Jenis:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Keterangan:</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
