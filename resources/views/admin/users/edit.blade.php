@extends('admin.layouts.app')
@section('title', 'Modifier utilisateur')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow"><a href="{{ route('admin.users.index') }}">Utilisateurs</a> / Edition</span>
        <h1 class="crumb-title">{{ $user->name }}</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-col main">
                <div class="form-card">
                    <h3 class="card-title">Profil</h3>

                    <div class="field">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label for="phone">Telephone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="field">
                            <label for="city">Ville</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}">
                        </div>
                    </div>

                    <div class="field">
                        <label for="address">Adresse</label>
                        <textarea id="address" name="address" rows="4">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-col side">
                <div class="form-card">
                    <h3 class="card-title">Acces</h3>

                    <div class="field">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            @foreach($roles as $role)
                                <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.users.index') }}" class="btn-ghost-sm">Annuler</a>
            <button type="submit" class="btn-primary-sm">Enregistrer</button>
        </div>
    </form>
@endsection