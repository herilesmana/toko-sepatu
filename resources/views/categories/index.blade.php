<x-app-layout>
    <x-slot name="header">Master Jenis</x-slot>
    <x-slot name="activeMenu">master-jenis</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i>
                Tambah Jenis
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr class="table-light">
                        <th>Nama Jenis</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-pencil"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau dihapus?')">
                                            <i class="mdi mdi-delete"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    {{-- If the categories table is empty, display a message to the user. --}}
                    @if ($categories->isEmpty())
                        <tr>
                            <td class="text-center" colspan="3">No categories found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        {{-- <div class="mt-4">
            {{ $categories->links() }}
        </div> --}}
    </div>

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('.table').DataTable();
            });
        </script>
    </x-slot>
</x-app-layout>
