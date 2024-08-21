<x-app-layout>
    <x-slot name="header">Master Sepatu</x-slot>
    <x-slot name="activeMenu">master-sepatu</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i>
                Tambah Sepatu
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr class="table-light">
                        <th>Nama Sepatu</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Merk</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
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
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-pencil"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau dihapus  ?')">
                                            <i class="mdi mdi-delete"></i>
                                            Delete
                                        </button>
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
        {{-- <div class="mt-4">
            {{ $products->links() }}
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
