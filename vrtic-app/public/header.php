<?php
require_once '../classes/User.php';
$user = new User();
if (!$user->isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrtić App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        .navbar {
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4) !important;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        h1, h2, h3, h4 {
            color: #ff6b6b;
        }
        .btn-primary {
            background: #4ecdc4;
            border: none;
        }
        .table thead {
            background: #ff9a9e;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="dashboard.php">🎨 Vrtić Sunce 🌞</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link fw-bold" href="children.php">👦 Deca</a>
                <a class="nav-link fw-bold" href="dashboard.php">🏠 Početna</a>
                <a class="nav-link text-white fw-bold" href="logout.php">
                    Odjava (<?= htmlspecialchars($_SESSION['username']) ?>)
                </a>
            </div>
        </div>
    </nav>