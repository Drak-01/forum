@extends('layouts.app')

@section('content')
<style>
    .auth-container {
        display: flex;
        min-height: 80vh;
        justify-content: center;
        align-items: center;
        background-color: #f9f9f9;
    }

    .register-box {
        display: flex;
        width: 80%;
        max-width: 1100px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-section {
        flex: 1;
        padding: 40px;
    }

    .form-section h2 {
        font-size: 24px;
        font-weight: bold;
    }

    .form-section p {
        color: #666;
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

    .form-error {
        color: red;
        font-size: 13px;
        margin-top: 5px;
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

    .image-section {
        flex: 1;
        background: url('https://images.unsplash.com/photo-1500648767791-00dcc994a43e') center center / cover no-repeat;
    }
</style>

<div class="auth-container">
    <div class="register-box">
        <div class="form-section">
            <h2>Join Alem Community</h2>
            <p>Get more features and privileges by joining the most helpful community</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Username" value="{{ old('name') }}" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                </div>

                <button type="submit" class="form-button">REGISTER</button>
            </form>
        </div>
        <div class="image-section"></div>
    </div>
</div>
@endsection
