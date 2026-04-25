@csrf

<div class="form-grid">
    <div class="form-col main">
        <div class="form-card">
            <h3 class="card-title">Informations generales</h3>

            <div class="field">
                <label for="name">Nom du produit</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="category_id">Categorie</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Choisir une categorie</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="sku">Reference SKU</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" placeholder="Auto genere si vide">
                </div>
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="6">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-card">
            <h3 class="card-title">Tarification et stock</h3>

            <div class="field-row">
                <div class="field">
                    <label for="price">Prix normal</label>
                    <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required>
                </div>

                <div class="field">
                    <label for="discount_price">Prix promo</label>
                    <input type="number" step="0.01" min="0" id="discount_price" name="discount_price" value="{{ old('discount_price', $product->discount_price ?? '') }}">
                </div>
            </div>

            <div class="field">
                <label for="stock">Stock</label>
                <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required>
            </div>
        </div>
    </div>

    <div class="form-col side">
        <div class="form-card">
            <h3 class="card-title">Visibilite</h3>

            <label class="switch">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
                <span class="switch-slider"></span>
                <span class="switch-label">
                    <strong>Produit actif</strong>
                    <em>Visible dans le catalogue public</em>
                </span>
            </label>
        </div>

        <div class="form-card">
            <h3 class="card-title">Image principale</h3>

            @if(isset($product) && $product->image_url)
                <div class="img-preview">
                    <img src="{{ $product->imageSrc() }}" alt="Image actuelle">
                </div>
            @endif

            <div class="field">
                <label for="image_url">URL image</label>
                <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $product->image_url ?? '') }}" placeholder="https://exemple.com/image.jpg ou products/mon-image.jpg">
            </div>

            <div class="file-drop">
                <span>Choisir une image locale</span>
                <em>PNG ou JPG, 4 Mo max. Upload prioritaire sur lURL si renseignee.</em>
                <input type="file" name="image_upload" accept="image/*">
            </div>

            <p style="margin-top:12px; color:var(--muted); font-size:12px; line-height:1.6;">
                Si vous utilisez un upload local, pensez a executer <code>php artisan storage:link</code> dans votre projet Laravel.
            </p>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.products.index') }}" class="btn-ghost-sm">Annuler</a>
    <button type="submit" class="btn-primary-sm">{{ $submitLabel ?? 'Enregistrer' }}</button>
</div>