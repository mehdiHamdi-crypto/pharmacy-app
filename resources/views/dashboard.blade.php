@include('layouts.header')

<h1>Dashboard</h1>

<p>Bienvenue {{ auth()->user()->name ?? 'Utilisateur' }} 👋</p>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:20px;">

    <div style="background:white;padding:20px;border-radius:8px;">
        <h3>Produits</h3>
        <p>Gérer les médicaments</p>
    </div>

    <div style="background:white;padding:20px;border-radius:8px;">
        <h3>Clients</h3>
        <p>Liste des clients</p>
    </div>

    <div style="background:white;padding:20px;border-radius:8px;">
        <h3>Commandes</h3>
        <p>Suivi des commandes</p>
    </div>

</div>

<div style="margin-top:30px;background:white;padding:20px;border-radius:8px;">
    <h2>Statistiques</h2>
    <p>Nombre de ventes aujourd'hui : 0</p>
    <p>Revenus : 0 DH</p>
</div>

@include('layouts.footer')