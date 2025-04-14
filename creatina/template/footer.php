<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Cara da Creatina - Rodapé</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados do rodapé */
        .footer {
            background-color: #000; /* Fundo preto */
            color: #fff; /* Texto branco */
        }

        .footer h5 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer a {
            text-decoration: none;
            color: #dcdcdc; /* Links em cinza claro */
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #ff4c4c; /* Cor vibrante para os links ao passar o mouse */
        }

        .footer .btn-floating {
            font-size: 1.2rem;
            border: 1px solid #fff; /* Borda branca */
            width: 40px;
            height: 40px;
            line-height: 40px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .footer .btn-floating:hover {
            color: #000;
            background-color: #ff4c4c; /* Fundo vermelho vibrante */
            border-color: #ff4c4c;
        }

        .footer hr {
            border-top: 1px solid #444; /* Linha separadora */
        }

        .footer-logo {
            height: 80px; /* Altura da logo */
            margin-bottom: 15px; /* Espaço entre a logo e o texto */
        }

        .footer p {
            font-size: 0.9rem; /* Tamanho do texto menor */
            line-height: 1.6; /* Espaçamento entre linhas */
        }
    </style>
</head>
<body>
    <!-- Rodapé -->
    <footer class="footer mt-auto py-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <!-- Sobre a empresa -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase text-white">O Cara da Creatina</h5>
                    <p class="text-light">
                        Mais energia, mais potência, mais definição! Entregamos a melhor creatina diretamente na sua porta para impulsionar o seu desempenho ao máximo. Seja na academia ou no dia a dia, você merece sempre mais.
                    </p>
                </div>

                <!-- Links úteis -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase text-white">Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Home</a></li>
                        <li><a href="#" class="text-light">Produtos</a></li>
                        <li><a href="sobre.php" class="text-light">Sobre Nós</a></li>
                        <li><a href="contato.php" class="text-light">Contato</a></li>
                    </ul>
                </div>

                <!-- Redes sociais -->
                <div class="col-md-4 mb-3 text-center text-md-start">
                    <h5 class="text-uppercase text-white">Redes sociais</h5>
                    <a href="https://www.facebook.com" class="btn btn-outline-light btn-floating me-2" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/ocaradacreatina?igsh=YmUxNzl2MmwzdW96" class="btn btn-outline-light btn-floating me-2" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/5534999758250?text=Opa%2C%20vim%20pelo%20Instagram%20e%20quero%20saber%20mais%20sobre%20seus%20produtos" class="btn btn-outline-light btn-floating me-2" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>

            </div>
            <hr class="text-light">
            <div class="text-center mb-3">
                <img src="img/logo.png" alt="Logo O Cara da Creatina" class="footer-logo">
            </div>
            <div class="text-center text-light">
                &copy; 2025 O Cara da Creatina. Todos os direitos reservados.
            </div>
        </div>
    </footer>
</body>
</html>
