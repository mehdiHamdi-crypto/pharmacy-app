@extends('admin.layouts.app')
@section('title', 'Commandes')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Commerce</span>
        <h1 class="crumb-title">Commandes</h1>
    </div>
@endsection

@section('content')
    <div class="toolbar">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="toolbar-filters">
            <div class="field-inline">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Numero, client ou email...">
            </div>
            <select name="status" class="field-select">
                <option value="">Tous les statuts</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-secondary-sm">Filtrer</button>
        </form>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Articles</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name ?? 'Client inconnu' }}</td>
                        <td>{{ $order->items_count }}</td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} MAD</td>
                        <td>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline-form">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="field-select">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="actions-col">
                            <a href="{{ route('admin.orders.show', $order) }}" class="act">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="table-empty">Aucune commande trouvee.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($orders->hasPages())
            <div class="table-foot">{{ $orders->links() }}</div>
        @endif
    </div>
@endsection