@csrf

<div class="form-grid">
    <div class="form-col main">
        <div class="form-card">
            <h3 class="card-title">Informations</h3>

            <div class="field">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="6">{{ old('description', $category->description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="form-col side">
        <div class="form-card">
            <h3 class="card-title">Statut</h3>
            <label class="switch">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))>
                <span class="switch-slider"></span>
                <span class="switch-label">
                    <strong>Categorie active</strong>
                    <em>Visible pour les produits du catalogue</em>
                </span>
            </label>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.categories.index') }}" class="btn-ghost-sm">Annuler</a>
    <button type="submit" class="btn-primary-sm">{{ $submitLabel }}</button>
</div>