@extends('admin.layouts.app')
@section('title', 'Modifier : '.$product->name)

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">
            <a href="{{ route('admin.products.index') }}">Produits</a> / Édition
        </span>
        <h1 class="crumb-title">{{ $product->name }}</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form', ['submitLabel' => 'Enregistrer les modifications'])
    </form>
@endsection