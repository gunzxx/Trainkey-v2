@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/profile.css">
@endsection

@section('content')
    <div class="edit-container">
        <div class="card-container">
            <h1> Password</h1>

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
                    <strong>{{ session()->get('success') }}</strong>
                    <span class="close-btn">X</span>
                </div>
            @endsession

            <form class="form-container" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-content">
                    <label for="old_password">Password Lama</label>
                    <div class="password">
                        <input type="password" name="old_password" maxlength="20" id="old_password" autocomplete="off" required=""
                            autofocus placeholder="Type here...">
                        <img src="img/eye-fill.svg" id="showPassword1" class="show-password">
                    </div>
                    @error('old_password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="password">Password</label>
                    <div class="password">
                        <input type="password" name="password" maxlength="20" id="password" autocomplete="off" required=""
                            autofocus placeholder="Type here...">
                        <img src="img/eye-fill.svg" id="showPassword1" class="show-password">
                    </div>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="password">
                        <input type="password" name="password_confirmation" maxlength="20" id="password_confirmation" autocomplete="off" required=""
                            placeholder="Type here...">
                        <img src="img/eye-fill.svg" id="showPassword2" class="show-password">
                    </div>
                    @error('password_confirmation')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" id="editBtn">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/password.js"></script>
@endsection
