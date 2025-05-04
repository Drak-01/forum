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
            <h2>Join Alem Community</h2>
            <p>Get more features and privileges by joining the most helpful community</p>

            {{-- <form method="POST" action="{{ route('register') }}">
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
            </form> --}}
            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf
            
                {{-- Prénom --}}
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        class="form-control @error('firstname') is-invalid @enderror"
                        placeholder="First Name"
                        value="{{ old('firstname') }}"
                        required
                    >
                    @error('firstname')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Nom --}}
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input
                        type="text"
                        id="lastname"
                        name="lastname"
                        class="form-control @error('lastname') is-invalid @enderror"
                        placeholder="Last Name"
                        value="{{ old('lastname') }}"
                        required
                    >
                    @error('lastname')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Username --}}
                <div class="form-group">
                    <label for="name">Username</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Username"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Téléphone --}}
                <div class="form-group">
                    <label for="tel">Phone</label>
                    <input
                        type="tel"
                        id="tel"
                        name="tel"
                        class="form-control @error('tel') is-invalid @enderror"
                        placeholder="Phone number"
                        value="{{ old('tel') }}"
                        required
                    >
                    @error('tel')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Adresse --}}
                <div class="form-group">
                    <label for="address">Address</label>
                    <input
                        type="text"
                        id="address"
                        name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Address"
                        value="{{ old('address') }}"
                        required
                    >
                    @error('address')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Centre d'intérêt --}}
                <div class="form-group">
                    <label for="centre_interet">Interests</label>
                    <input
                        type="text"
                        id="centre_interet"
                        name="centre_interet"
                        class="form-control @error('centre_interet') is-invalid @enderror"
                        placeholder="Interests (comma-separated)"
                        value="{{ old('centre_interet') }}"
                    >
                    @error('centre_interet')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Mot de passe --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            
                {{-- Confirmation du mot de passe --}}
                <div class="form-group">
                    <label for="password_confirmation">Repeat Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Repeat password"
                        required
                        autocomplete="new-password"
                    >
                </div>
            
                {{-- Bouton d'envoi --}}
                <button type="submit" class="form-button">REGISTER</button>
            </form>
            
            
        </div>
        <div class="image-section"></div>
    </div>
</div>
@endsection
