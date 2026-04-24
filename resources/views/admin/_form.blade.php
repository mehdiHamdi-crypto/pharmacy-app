@csrf
<div class="form-grid">
    <div class="form-col main">

        <div class="form-card">
            <h3 class="card-title">Informations générales</h3>

            <div class="field">
                <label for="name">Nom du produit</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name', $product->name ?? '') }}" required>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="category_id">Catégorie</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">— Choisir une catégorie —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                @selected(old('category_id', $product->category_id ?? '') == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="sku">Référence (SKU)</label>
                    <input type="text" id="sku" name="sku"
                           value="{{ old('sku', $product->sku ?? '') }}"
                           placeholder="Auto-généré si vide">
                </div>
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="6"
                          placeholder="Présentez le produit, ses bénéfices, sa posologie...">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-card">
            <h3 class="card-title">Tarification & stock</h3>
            <div class="field-row">
                <div class="field">
                    <label for="price">Prix normal (MAD)</label>
                    <input type="number" step="0.01" min="0" id="price" name="price"
                           value="{{ old('price', $product->price ?? '') }}" required>
                </div>
                <div class="field">
                    <label for="discount_price">Prix promo (optionnel)</label>
                    <input type="number" step="0.01" min="0" id="discount_price" name="discount_price"
                           value="{{ old('discount_price', $product->discount_price ?? '') }}"
                           placeholder="Inférieur au prix normal">
                </div>
            </div>
            <div class="field">
                <label for="stock">Stock disponible</label>
                <input type="number" min="0" id="stock" name="stock"
                       value="{{ old('stock', $product->stock ?? 0) }}" required>
            </div>
        </div>
    </div>

    <div class="form-col side">
        <div class="form-card">
            <h3 class="card-title">Visibilité</h3>
            <label class="switch">
                <input type="checkbox" name="is_active" value="1"
                       @checked(old('is_active', $product->is_active ?? true))>
                <span class="switch-slider"></span>
                <span class="switch-label">
                    <strong>Produit actif</strong>
                    <em>Visible dans le catalogue public</em>
                </span>
            </label>
        </div>

        <div class="form-card">
            <h3 class="card-title">Image principale</h3>

            {{-- ======================================================
                 APERÇU IMAGE EXISTANTE
                 S'affiche uniquement si une image a déjà été uploadée
            ====================================================== --}}
            @if(isset($product) && $product->image_url)
                <div class="img-preview">
                    <img
                        src="{{ asset('storage/' . $product->image_url) }}"
                        alt="Image actuelle"
                        style="width:100%; height:200px; object-fit:cover; border-radius:8px; display:block;"
                        onerror="this.style.display='none'; document.getElementById('img-error').style.display='block';"
                    >
                    {{-- Message affiché si storage:link n'est pas fait --}}
                    <p id="img-error" style="display:none; color:#c0392b; font-size:13px; margin-top:8px;">
                        ⚠️ Image introuvable. Lance <code>php artisan storage:link</code>
                    </p>
                    <p style="font-size:12px; color:#888; margin-top:6px;">
                        Chemin stocké : <code>{{ $product->image_url }}</code>
                    </p>
                </div>
            @endif

            <div class="file-drop">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
                <span>Cliquez pour choisir une image</span>
                <em>PNG, JPG · 4 Mo max</em>
                <input type="file" name="image" accept="image/*">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.products.index') }}" class="btn-ghost-sm">Annuler</a>
    <button type="submit" class="btn-primary-sm">{{ $submitLabel ?? 'Enregistrer' }}</button>
</div>
