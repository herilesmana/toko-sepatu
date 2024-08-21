<x-app-layout>
    <x-slot name="header">Master Merk</x-slot>
    <x-slot name="activeMenu">master-merk</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('brands.create') }}" class="btn btn-primary">Tambah Merk</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr class="table-light">
                        <th>Nama Merk</th>
                        <th>Keterangan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-pencil"></i>
                                        Edit
                                    </a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau dihapus?')">
                                        <i class="mdi mdi-delete"></i>
                                        Hapus
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
    
                    {{-- If the brands table is empty, display a message to the user. --}}
                    @if ($brands->isEmpty())
                        <tr>
                            <tdtext-center" colspan="3">No brands found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $brands->links() }}
        </div>
    </div>
</x-app-layout>
