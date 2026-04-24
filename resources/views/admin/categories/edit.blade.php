@extends('admin.layouts.app')
@section('title', 'Modifier categorie')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow"><a href="{{ route('admin.categories.index') }}">Categories</a> / Edition</span>
        <h1 class="crumb-title">{{ $category->name }}</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @method('PUT')
        @include('admin.categories.partials.form', ['submitLabel' => 'Enregistrer'])
    </form>
@endsection