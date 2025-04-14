<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Cara da Creatina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/21c4f0d2e3.js" crossorigin="anonymous"></script>
    <style>
        @font-face {
            font-family: 'Ambulance Shotgun';
            src: url('fonts/ambulance_shotgun.ttf') format('truetype');
        }

        body {
            margin: 0;
            background-color: #000;
            color: #fff;
            font-family: 'Oswald', sans-serif;
        }

        .navbar {
            background-color: #000;
            padding: 5px 20px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 2rem !important;
            color: #fff !important;
            font-family: 'Ambulance Shotgun', sans-serif !important;
            font-weight: 700;
            letter-spacing: 4px;
        }

        .navbar-brand img {
            height: 50px;
            margin-right: 15px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-size: 1.1rem;
            padding: 6px 10px;
            font-weight: 600;
            text-transform: uppercase;
            transition: color 0.3s, border-bottom 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ff4c4c;
            border-bottom: 2px solid #ff4c4c;
        }

        .cart-btn {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 6px 15px;
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            font-family: 'Oswald', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .cart-btn:hover {
            background-color: #fff;
            color: #000;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.6rem !important;
            }

            .navbar-brand img {
                height: 40px;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo1.png" alt="Logo O Cara da Creatina">
                O Cara da Creatina
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contato.php">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#carrinhoModal">
                            <i class="fa-solid fa-cart-shopping"></i> 
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
