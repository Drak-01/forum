@extends('auth.app')

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
                <h2>Join ENSISAD Community</h2>
                <p>Get more features and privileges by joining the most helpful community</p>
                <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                            required>
                        @error('username')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="univEmail">University Email</label>
                        <input type="email" name="univEmail" id="univEmail"
                            class="form-control @error('univEmail') is-invalid @enderror" value="{{ old('univEmail') }}"
                            required>
                        @error('univEmail')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirmation du mot de passe --}}
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            required>
                    </div>

                    {{-- Nom --}}
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName"
                            class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName') }}"
                            required>
                        @error('lastName')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Prénom --}}
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName"
                            class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName') }}"
                            required>
                        @error('firstName')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Photo de profil --}}
                    <div class="form-group">
                        <label for="userPicture">Profile Picture (optional)</label>
                        <input type="file" name="userPicture" id="userPicture"
                            class="form-control-file @error('userPicture') is-invalid @enderror" accept="image/*">
                        @error('userPicture')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bouton d'inscription --}}
                    <button type="submit" class="form-button">Register</button>
                </form>



            </div>
            <div class="image-section"></div>
        </div>
    </div>
@endsection
