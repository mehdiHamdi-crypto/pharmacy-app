@extends('admin.layouts.app')
@section('title', 'Utilisateurs')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Gestion</span>
        <h1 class="crumb-title">Utilisateurs</h1>
    </div>
@endsection

@section('content')
    <div class="toolbar">
        <form method="GET" action="{{ route('admin.users.index') }}" class="toolbar-filters">
            <div class="field-inline">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Nom, email, telephone...">
            </div>
            <select name="role" class="field-select">
                <option value="">Tous les roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-secondary-sm">Filtrer</button>
        </form>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Ville</th>
                    <th>Role</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?: '-' }}</td>
                        <td>{{ $user->city ?: '-' }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td class="actions-col">
                            <a href="{{ route('admin.users.edit', $user) }}" class="act">Editer</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="act act-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="table-empty">Aucun utilisateur trouve.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($users->hasPages())
            <div class="table-foot">{{ $users->links() }}</div>
        @endif
    </div>
@endsection