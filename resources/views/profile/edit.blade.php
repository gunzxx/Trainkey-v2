@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/profile.css">
@endsection

@section('content')
    <div class="edit-container">
        <div class="card-container">
            <h1>Edit Profile</h1>

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

            <form class="form-container" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-content">
                    <label for="profile">Foto Profile</label>

                    <img id="preview-inv-img" src="{{ $user->getFirstMediaUrl('profile') == '' ? '/img/profile/default.png' : $user->getFirstMediaUrl('profile') }}">

                    <input type="file" name="profile" accept="image/*" maxlength="20" id="profileInput" autocomplete="off"
                        placeholder="Type here...">
                    @error('profile')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="20" id="email" autocomplete="off" required=""
                        autofocus placeholder="Type here..." value="{{ old('email', $user->email) }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-content">
                    <label for="username">Username</label>
                    <input type="text" name="username" maxlength="20" id="username" autocomplete="off" required=""
                        placeholder="Type here..." value="{{ old('username', $user->name) }}">
                    @error('username')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" id="editBtn">Simpan</button>
            </form>

            <div class="delete-account-container">
                <button type="button" id="deleteAccountBtn">Hapus akun</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/function.js"></script>
    <script src="/js/profile.js"></script>
@endsection
