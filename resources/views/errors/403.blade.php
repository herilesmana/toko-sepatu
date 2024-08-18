<x-guest-layout>
    <x-slot name="header">Forbidden!</x-slot>

    <div class="d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="display-1 fw-bold text-warning">403</h1>
            <p class="fs-3"> <span class="text-danger">Oops!</span> Forbidden.</p>
            <p class="lead">
                You do not have permission to access this page.
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
        </div>
    </div>
</x-guest-layout>