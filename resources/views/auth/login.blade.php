@extends('layouts.app')
@section('title', 'Login | Thriftees')

@section('content')
    <div class="form-wrapper col-md-4">
        <h1 class="fw-bold mb-1">Login Thriftees</h1>
        <p class="text-center text-muted">Masuk dan nikmati semua fiturnya</p>
        <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Lupa Password
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-sm text-white px-3">Login</button>
        </form>
    </div>
@endsection
