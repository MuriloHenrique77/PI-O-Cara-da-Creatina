<?php
include "template/header.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - O Cara da Creatina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ======= ESTILOS GERAIS ======= */
        body {
            background-color: #000000; /* Fundo preto */
            color: #ffffff;            /* Texto em branco para contraste */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 30px 0;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* ======= SEÇÃO DE TEXTO ======= */
        section {
            background-color: #1c1c1c; /* Tom de cinza-escuro que contrasta com o fundo preto */
            color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1); /* Sombra clara */
            padding: 20px;
            margin-bottom: 20px;
        }

        section h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            text-align: center;
        }

        section p {
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }

        /* ======= FORMULÁRIO ======= */
        form {
            background-color: #1c1c1c; /* Mesmo fundo do "card" */
            color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        form .form-group {
            margin-bottom: 15px;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Inputs e textarea com fundo escuro e texto claro */
        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #666;
            border-radius: 4px;
            font-size: 1rem;
            background-color: #333333; 
            color: #ffffff;
        }

        /* Placeholder mais claro */
        ::-webkit-input-placeholder {
            color: #aaaaaa;
        }
        :-ms-input-placeholder {
            color: #aaaaaa;
        }
        ::placeholder {
            color: #aaaaaa;
        }

        /* Botão no estilo usado nos demais */
        form button {
            background-color: #ff4c4c;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #e84343;
        }

        /* ======= RODAPÉ ======= */
        footer {
            background-color: #111111;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
        }

        footer a {
            color: #ff4c4c;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* ======= RESPONSIVIDADE ======= */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            section h2 {
                font-size: 1.4rem;
            }

            section p {
                font-size: 1rem;
            }

            form button {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Contato</h1>
</header>

<main>
    <!-- Seção introdutória -->
    <section>
        <h2>Fale Conosco</h2>
        <p>
            Se você tiver dúvidas, sugestões ou precisar de assistência, preencha o formulário abaixo. 
            Retornaremos o mais breve possível!
        </p>
    </section>

    <!-- Formulário de contato -->
    <form action="envia_contato.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
        </div>

        <div class="form-group">
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem aqui..." required></textarea>
        </div>

        <button type="submit">Enviar</button>
    </form>
</main>

<!-- Rodapé -->
<?php include "template/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
