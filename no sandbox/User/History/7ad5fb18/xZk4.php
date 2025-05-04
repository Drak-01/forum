@extends('auth.app')

@section('content')
<style>
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background-color: #f9f9f9;
    }

    .login-box {
        display: flex;
        width: 70%;
        max-width: 900px;
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        flex: 1;
        padding: 40px;
    }

    .form-section h2 {
        font-size: 24px;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .form-button {
        width: 100%;
        background-color: #f7941e;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
    }

    .form-error {
        color: red;
        font-size: 13px;
        margin-top: 5px;
    }

    .image-section {
        flex: 1;
        background: url('https://images.unsplash.com/photo-1524253482453-3fed8d2fe12b') center center / cover no-repeat;
    }
</style>

<div class="auth-container">
    <div class="login-box">
        <div class="form-section">
            <h2>Login to Alem</h2>
            <form method="POST" action="{{ route('login.check') }}">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="form-button">LOGIN</button>
            </form>
        </div>
        <div class="image-section"></div>
    </div>
</div>
@endsection
