@extends('admin.layouts.app')
@section('title', 'Categories')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Catalogue</span>
        <h1 class="crumb-title">Categories</h1>
    </div>
@endsection

@section('content')
    <div class="toolbar">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="toolbar-filters">
            <div class="field-inline">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher une categorie...">
            </div>
            <select name="status" class="field-select">
                <option value="">Tous les statuts</option>
                <option value="active" @selected(request('status') === 'active')>Actives</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactives</option>
            </select>
            <button type="submit" class="btn-secondary-sm">Filtrer</button>
        </form>

        <a href="{{ route('admin.categories.create') }}" class="btn-primary-sm">Nouvelle categorie</a>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Produits</th>
                    <th>Statut</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($category->description, 80) }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="actions-col">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="act">Editer</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="act act-danger" onclick="return confirm('Supprimer cette categorie ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="table-empty">Aucune categorie trouvee.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($categories->hasPages())
            <div class="table-foot">{{ $categories->links() }}</div>
        @endif
    </div>
@endsection