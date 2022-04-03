@extends('layouts.app')
@section('title', 'Register | Thriftees')

@section('content')
    <div class="form-wrapper col-md-4">
        <h1 class="fw-bold mb-1">Register Thriftees</h1>
        <p class="text-center text-muted">Buat akun kamu dan nikmati semua fiturnya</p>
        <hr>

        @if (session('errorStatus'))
            <div class="alert alert-danger"><i class="uil uil-times me-2"></i>{{ session('errorStatus') }}</div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email: </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">No. Telepon</label>
                <input id="no_telepon" type="number" class="form-control @error('no_telepon') is-invalid @enderror"
                    name="no_telepon" value="{{ old('no_telepon') }}" required autocomplete="no_telepon" autofocus>
                @error('no_telepon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary btn-sm text-white px-3">Register</button>
        </form>
    </div>
@endsection
