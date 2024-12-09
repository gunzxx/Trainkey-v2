@extends('layouts.auth')

@section('css')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/register.css">
@endsection

@section('content')
    <div class="login-container">
        <div class="card-container">
            <h1>Register</h1>

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
                    <strong>{{ $error }}</strong>
                    <span class="close-btn">X</span>
                </div>
            @endsession

            <form class="form-container" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-content">
                    <label for="profile">Foto Profile</label>
                    
                    <img id="preview-inv-img" src="/img/profile/default.png">
                    
                    <input type="file" name="profile" accept="image/*" maxlength="20" id="profile" autocomplete="off" placeholder="Type here...">
                    @error('profile')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="20" id="email" autocomplete="off" required="" autofocus placeholder="Type here..." value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="username">Username</label>
                    <input type="text" name="username" maxlength="20" id="username" autocomplete="off" required="" placeholder="Type here..." value="{{ old('username') }}">
                    @error('username')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="password">Password</label>
                    <div class="password">
                        <input type="password" name="password" id="password" autocomplete="off" required="" placeholder="Type here...">
                        <img src="img/eye-fill.svg" id="showpassword1" class="show-password">
                    </div>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="password2">Retype password</label>
                    <div class="password">
                        <input type="password" name="password_confirmation" id="password2" autocomplete="off" required="" placeholder="Type here...">
                        <img src="img/eye-fill.svg" id="showpassword2" class="show-password">
                    </div>
                </div>
                <legend>
                    <a href="/login" class="login">Sudah punya akun?</a>
                    <a href="/forgot_password" class="forgot">Lupa password?</a>
                </legend>
                <button type="submit" id="daftar">Daftar</button>
            </form>
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/register.js"></script>
@endsection
