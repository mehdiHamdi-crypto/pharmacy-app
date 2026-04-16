<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style simple -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .navbar {
            background-color: #2c3e50;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div><strong>Pharmacy App</strong></div>

    <div>
        <a href="/">Accueil</a>
        <a href="/dashboard">Dashboard</a>

        @auth
            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button style="background:none;border:none;color:white;cursor:pointer;">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        @endguest
    </div>
</div>

<div class="container">