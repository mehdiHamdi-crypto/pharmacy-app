@extends('admin.layouts.app')
@section('title', 'Nouvelle categorie')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow"><a href="{{ route('admin.categories.index') }}">Categories</a> / Nouvelle</span>
        <h1 class="crumb-title">Creer une categorie</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @include('admin.categories.partials.form', ['submitLabel' => 'Creer la categorie'])
    </form>
@endsection