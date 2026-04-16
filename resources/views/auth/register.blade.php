@extends('layouts.app')

@section('title', 'Inscription - PharmaCare')

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
        margin-bottom: 30px;
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
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-group input:focus, .form-group select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-group.error input,
    .form-group.error select {
        border-color: var(--danger);
    }

    .form-error {
        color: var(--danger);
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .form-terms {
        margin-bottom: 20px;
        font-size: 13px;
        color: var(--text-light);
    }

    .form-terms label {
        font-weight: 400;
        margin-bottom: 0;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .form-terms input {
        width: auto;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .form-terms a {
        color: var(--primary-color);
        text-decoration: none;
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
        margin-bottom: 15px;
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
    }

    .auth-footer {
        text-align: center;
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

    .password-requirement {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 8px;
        display: none;
    }

    .password-requirement.active {
        display: block;
    }

    .requirement-item {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 4px 0;
    }

    .requirement-item.met {
        color: var(--success);
    }

    .requirement-item.unmet {
        color: var(--danger);
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Créer un Compte</h1>
            <p>Rejoignez PharmaCare en quelques secondes</p>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group @error('first_name') error @enderror">
                    <label for="first_name">Prénom</label>
                    <input 
                        type="text" 
                        id="first_name" 
                        name="first_name" 
                        placeholder="Ahmed"
                        value="{{ old('first_name') }}"
                        required
                    >
                    @error('first_name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group @error('last_name') error @enderror">
                    <label for="last_name">Nom</label>
                    <input 
                        type="text" 
                        id="last_name" 
                        name="last_name" 
                        placeholder="Alami"
                        value="{{ old('last_name') }}"
                        required
                    >
                    @error('last_name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group @error('email') error @enderror">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="votre.email@example.com"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('phone') error @enderror">
                <label for="phone">Téléphone</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    placeholder="+212 6XX XXX XXX"
                    value="{{ old('phone') }}"
                >
                @error('phone')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('city') error @enderror">
                <label for="city">Ville</label>
                <input 
                    type="text" 
                    id="city" 
                    name="city" 
                    placeholder="Tanger"
                    value="{{ old('city') }}"
                >
                @error('city')
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
                    oninput="checkPassword()"
                >
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <div class="password-requirement" id="passwordReq">
                    <div class="requirement-item" id="length">✗ Minimum 8 caractères</div>
                    <div class="requirement-item" id="uppercase">✗ Au moins une majuscule</div>
                    <div class="requirement-item" id="lowercase">✗ Au moins une minuscule</div>
                    <div class="requirement-item" id="number">✗ Au moins un chiffre</div>
                </div>
            </div>

            <div class="form-group @error('password_confirmation') error @enderror">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="••••••••"
                    required
                >
                @error('password_confirmation')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-terms">
                <label>
                    <input type="checkbox" name="accept_terms" required>
                    <span>J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Créer mon compte</button>

            <div class="auth-footer">
                Vous avez déjà un compte? <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </form>
    </div>
</div>

<script>
function checkPassword() {
    const password = document.getElementById('password').value;
    const req = document.getElementById('passwordReq');
    const lengthEl = document.getElementById('length');
    const uppercaseEl = document.getElementById('uppercase');
    const lowercaseEl = document.getElementById('lowercase');
    const numberEl = document.getElementById('number');

    if (password.length > 0) {
        req.classList.add('active');
    } else {
        req.classList.remove('active');
    }

    // Check length
    if (password.length >= 8) {
        lengthEl.classList.remove('unmet');
        lengthEl.classList.add('met');
        lengthEl.textContent = '✓ Minimum 8 caractères';
    } else {
        lengthEl.classList.remove('met');
        lengthEl.classList.add('unmet');
        lengthEl.textContent = '✗ Minimum 8 caractères';
    }

    // Check uppercase
    if (/[A-Z]/.test(password)) {
        uppercaseEl.classList.remove('unmet');
        uppercaseEl.classList.add('met');
        uppercaseEl.textContent = '✓ Au moins une majuscule';
    } else {
        uppercaseEl.classList.remove('met');
        uppercaseEl.classList.add('unmet');
        uppercaseEl.textContent = '✗ Au moins une majuscule';
    }

    // Check lowercase
    if (/[a-z]/.test(password)) {
        lowercaseEl.classList.remove('unmet');
        lowercaseEl.classList.add('met');
        lowercaseEl.textContent = '✓ Au moins une minuscule';
    } else {
        lowercaseEl.classList.remove('met');
        lowercaseEl.classList.add('unmet');
        lowercaseEl.textContent = '✗ Au moins une minuscule';
    }

    // Check number
    if (/[0-9]/.test(password)) {
        numberEl.classList.remove('unmet');
        numberEl.classList.add('met');
        numberEl.textContent = '✓ Au moins un chiffre';
    } else {
        numberEl.classList.remove('met');
        numberEl.classList.add('unmet');
        numberEl.textContent = '✗ Au moins un chiffre';
    }
}
</script>

@endsection