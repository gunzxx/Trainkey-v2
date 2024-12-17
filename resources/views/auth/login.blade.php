@extends('layouts.auth')

@section('css')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <div class="login-container">
        <div class="card-container">
            <h1>Login</h1>
            
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error-banner message">
                        <strong>{{ $error }}</strong>
                        <span class="close-btn">X</span>
                    </div>
                @endforeach
            @endif

            @session('success')
                <div class="success-banner message">
                    <strong>{{ session('success') }}</strong>
                    <span class="close-btn">X</span>
                </div>
            @endsession

            <form class="form-container" method="POST">
                @csrf
                <div class="form-content email">
                    <label for="email">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" id="email" autocomplete="off" required="" autofocus
                        placeholder="Masukkan email">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content password">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required=""
                        placeholder="Masukkan password">
                    <img style="color: red;" src="img/eye-fill.svg" id="showpassword">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div class="form-content remember">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">remember me</label>
                </div> --}}
                <legend>
                    <a href="/register" class="daftar">Tidak punya akun?</a>
                    {{-- <a href="/forgot_password" class="forgot">Lupa password?</a> --}}
                </legend>
                <button type="submit" id="login">Login</button>
            </form>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/login.js"></script>
@endsection
