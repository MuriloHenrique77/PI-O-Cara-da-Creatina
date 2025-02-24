<?php
include "template/header.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - O Cara da Creatina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000000; /* Fundo preto */
            color: #ffffff;            /* Texto em branco para contraste */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Cabeçalho */
        header {
            text-align: center;
            padding: 30px 0;
        }

        header h1 {
            font-size: 2.8rem;
            font-weight: bold;
            margin: 0;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Seções "estilo card" */
        section {
            background-color: #1c1c1c; /* Tom de cinza escuro (mesmo usado nos cards) */
            color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1); /* Sombra clara para destacar no fundo preto */
            padding: 20px;
            margin-bottom: 20px;
        }

        section h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #ffffff;
            text-align: center;
        }

        section p,
        section ul {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #ffffff;
            text-align: justify;
        }

        ul {
            padding-left: 20px;
        }

        /* Rodapé */
        footer {
            background-color: #111111; /* Ligeiramente diferente do fundo principal */
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        footer a {
            color: #ff4c4c;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            main {
                padding: 20px;
            }

            section h2 {
                font-size: 1.6rem;
            }

            section p,
            section ul {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Sobre Nós</h1>
</header>

<main>
    <section>
        <h2>O Cara da Creatina</h2>
        <p>
            Bem-vindo ao O Cara da Creatina, seu destino número um para suplementação de qualidade. Nosso objetivo é oferecer as melhores creatinas do mercado, combinando preços acessíveis com uma experiência de compra prática e segura.
        </p>
    </section>

    <section>
        <h2>Nosso Compromisso</h2>
        <p>
            Estamos comprometidos em proporcionar produtos confiáveis, entrega ágil e atendimento excepcional. Valorizamos sua saúde e desempenho, e por isso, selecionamos cuidadosamente nossos produtos para garantir qualidade superior.
        </p>
    </section>

    <section>
        <h2>Por Que Escolher a Gente?</h2>
        <ul>
            <li>Entrega rápida e segura diretamente na sua porta.</li>
            <li>Os melhores preços do mercado.</li>
            <li>Suplementos selecionados e de alta qualidade.</li>
            <li>Atendimento dedicado e suporte ao cliente.</li>
        </ul>
    </section>
</main>

<?php include "template/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
