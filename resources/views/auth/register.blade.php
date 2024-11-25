@extends('layouts.auth')

@section('css')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/register.css">
@endsection

@section('content')
    <p class="notify" id="notify">
        Notify
    </p>

    <!-- Navbar -->
    <div class="nav">
        <a href="/" class="brand">
            <img src="/img/logo.png" alt="" width="70px">
            <h1>Train Key</h1>
        </a>
        <div class="sub-nav">
            <a class="nav-list">
                <p>Help & Support</p>
            </a>
            <a class="nav-list">
                <p>Documentation</p>
            </a>
        </div>
    </div>
    <!-- End Navbar -->


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

            <form class="form-container" method="POST">
                @csrf
                <fieldset class="form-profile">
                    <legend>Pilih foto profil : </legend>
                    <label for="profile1">
                        <input checked type="radio" name="profile" id="profile1" value="1">
                        <img class="profile-img" src="img/pfp/pfp1.png">
                    </label>
                    <label for="profile2">
                        <input type="radio" name="profile" id="profile2" value="2">
                        <img class="profile-img" src="img/pfp/pfp2.png">
                    </label>
                    <label for="profile3">
                        <input type="radio" name="profile" id="profile3" value="3">
                        <img class="profile-img" src="img/pfp/pfp3.png">
                    </label>
                    <label for="profile4">
                        <input type="radio" name="profile" id="profile4" value="4">
                        <img class="profile-img" src="img/pfp/pfp4.png">
                    </label>
                    <label for="profile5">
                        <input type="radio" name="profile" id="profile5" value="5">
                        <img class="profile-img" src="img/pfp/pfp5.png">
                    </label>
                    <label for="profile6">
                        <input type="radio" name="profile" id="profile6" value="6">
                        <img class="profile-img" src="img/pfp/pfp6.png">
                    </label>
                    <label for="profile7">
                        <input type="radio" name="profile" id="profile7" value="7">
                        <img class="profile-img" src="img/pfp/pfp7.png">
                    </label>
                    <label for="profile8">
                        <input type="radio" name="profile" id="profile8" value="8">
                        <img class="profile-img" src="img/pfp/pfp8.png">
                    </label>
                    <label for="profile9">
                        <input type="radio" name="profile" id="profile9" value="9">
                        <img class="profile-img" src="img/pfp/pfp9.png">
                    </label>
                    <label for="profile10">
                        <input type="radio" name="profile" id="profile10" value="10">
                        <img class="profile-img" src="img/pfp/pfp10.png">
                    </label>
                    <label for="profile11">
                        <input type="radio" name="profile" id="profile11" value="11">
                        <img class="profile-img" src="img/pfp/pfp11.png">
                    </label>
                    <label for="profile12">
                        <input type="radio" name="profile" id="profile12" value="12">
                        <img class="profile-img" src="img/pfp/pfp12.png">
                    </label>
                    <label for="profile13">
                        <input type="radio" name="profile" id="profile13" value="13">
                        <img class="profile-img" src="img/pfp/pfp13.png">
                    </label>
                    <label for="profile14">
                        <input type="radio" name="profile" id="profile14" value="14">
                        <img class="profile-img" src="img/pfp/pfp14.png">
                    </label>
                    <label for="profile15">
                        <input type="radio" name="profile" id="profile15" value="15">
                        <img class="profile-img" src="img/pfp/pfp15.png">
                    </label>
                    <label for="profile16">
                        <input type="radio" name="profile" id="profile16" value="16">
                        <img class="profile-img" src="img/pfp/pfp16.png">
                    </label>
                </fieldset>
                <div class="form-content">
                    <img src="img/pfp/pfp1.png" id="preview-profile" width="100px" alt="">
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
                    <input type="text" name="username" maxlength="20" id="username" autocomplete="off" required="" autofocus placeholder="Type here..." value="{{ old('username') }}">
                    @error('username')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="password">Password</label>
                    <div class="password">
                        <input type="password" name="password" id="password" autocomplete="off" required="" autofocus placeholder="Type here...">
                        <img src="img/eye-fill.svg" id="showpassword1" class="show-password">
                    </div>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="password2">Retype password</label>
                    <div class="password">
                        <input type="password" name="password_confirmation" id="password2" autocomplete="off" required="" autofocus placeholder="Type here...">
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
