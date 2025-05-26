@extends('layouts.auth_layout')

@section('title', 'Login')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card border-0 shadow-sm" style="width: 400px; border-radius: 16px;">
            <div class="card-body px-4 py-5 text-center">

                {{-- Logo --}}
                <img src="{{ asset('images/logo-news360.png') }}" alt="360 News" class="mb-3" style="max-height: 50px;">

                {{-- Subtitle --}}
                <p class="text-primary fw-semibold mb-4">Login 360 News untuk menggunakan layanan kami</p>

                {{-- Alert Message (jika error) --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                    </div>

                    <div class="mb-4 text-start">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-bold text-white"
                        style="background-color: #FF6600; border: none;">
                        Log in
                    </button>
                </form>

                {{-- Footer Link --}}
                {{-- <div class="mt-4">
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">Daftar?</a>
                    <span class="text-muted">Atau</span>
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Lupa password?</a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
