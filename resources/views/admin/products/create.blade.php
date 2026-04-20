@extends('admin.layouts.app')
@section('title', 'Nouveau produit')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">
            <a href="{{ route('admin.products.index') }}">Produits</a> / Nouveau
        </span>
        <h1 class="crumb-title">Créer un produit</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.products._form', ['submitLabel' => 'Créer le produit'])
    </form>
@endsection