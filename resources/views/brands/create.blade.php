<x-app-layout>
    <x-slot name="header">Add Brand</x-slot>
    <x-slot name="activeMenu">brands</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('brands.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Add Brand</button>
                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
