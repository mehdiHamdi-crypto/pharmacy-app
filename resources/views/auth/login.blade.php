@extends('layouts.app')

@section('title', 'Connexion - PharmaCare')

@section('content')

<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--white) 100%);
        padding: 40px 0;
    }

    .auth-card {
        background: var(--white);
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        padding: 40px;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .auth-header h1 {
        font-size: 28px;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    .auth-header p {
        color: var(--text-light);
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-group.error input {
        border-color: var(--danger);
    }

    .form-error {
        color: var(--danger);
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }

    .form-remember {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .form-remember input[type="checkbox"] {
        width: auto;
        margin-right: 8px;
    }

    .form-remember label {
        margin: 0;
        display: flex;
        align-items: center;
        font-weight: 400;
    }

    .form-remember a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .form-remember a:hover {
        text-decoration: underline;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: var(--primary-color);
        color: var(--white);
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
    }

    .auth-footer {
        text-align: center;
        border-top: 1px solid var(--border-color);
        padding-top: 20px;
        font-size: 14px;
        color: var(--text-light);
    }

    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    .divider {
        text-align: center;
        margin: 20px 0;
        color: var(--text-light);
        font-size: 13px;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: var(--border-color);
    }

    .divider span {
        background: var(--white);
        padding: 0 10px;
        position: relative;
    }

    .social-login {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-btn {
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background: var(--white);
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .social-btn:hover {
        border-color: var(--primary-color);
        background: var(--primary-light);
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Connexion</h1>
            <p>Connectez-vous à votre compte PharmaCare</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                ⚠️
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group @error('email') error @enderror">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="votre.email@example.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('password') error @enderror">
                <label for="password">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-remember">
                <label>
                    <input type="checkbox" name="remember">
                    Se souvenir de moi
                </label>
                <a href="#">Mot de passe oublié?</a>
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <div class="divider"><span>OU</span></div>

        <div class="social-login">
            <button class="social-btn">👕 Google</button>
            <button class="social-btn">f Facebook</button>
        </div>

        <div class="auth-footer">
            Vous n'avez pas de compte? <a href="{{ route('register') }}">Créer un compte</a>
        </div>
    </div>
</div>

@endsection