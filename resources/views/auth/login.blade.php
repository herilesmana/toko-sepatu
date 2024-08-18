<x-guest-layout>
    <!-- Session Status session('status') -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Session Status -->
        @if(session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @if($errors->has('email'))
                <div class="text-danger mt-2">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
            @if($errors->has('password'))
                <div class="text-danger mt-2">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">
                Remember me
            </label>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            {{-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-muted">Forgot your password?</a>
            @endif --}}
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>
    </form>
</x-guest-layout>
