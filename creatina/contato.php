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


<!-- MODAL CARRINHO -->
<div class="modal fade" id="carrinhoModal" tabindex="-1" aria-labelledby="carrinhoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white border-white">
      <div class="modal-header">
        <h5 class="modal-title" id="carrinhoModalLabel">Seu Carrinho</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <?php if (!empty($_SESSION['carrinho'])): ?>
          <?php $total = 0; ?>
          <ul class="list-group list-group-flush">
            <?php foreach ($_SESSION['carrinho'] as $item): 
              $total += $item['preco'];
            ?>
              <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                <div>
                  <?= htmlspecialchars($item['nome']); ?><br>
                  <small class="text-success">R$ <?= number_format($item['preco'], 2, ',', '.'); ?></small>
                </div>
                <button class="btn btn-sm btn-danger remover-item" data-id="<?= $item['id']; ?>" title="Remover">
                    <i class="fa-solid fa-trash"></i>
                </button>
              </li>
            <?php endforeach; ?>

            <!-- TOTAL -->
            <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center fw-bold border-top mt-3 pt-2">
              Total
              <span>R$ <?= number_format($total, 2, ',', '.'); ?></span>
            </li>
          </ul>
        <?php else: ?>
          <p class="text-center">Ainda não há produtos no carrinho.</p>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a href="finalizar.php" class="btn btn-danger">Finalizar Compra</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.remover-item').forEach(btn => {
  btn.addEventListener('click', function () {
    const id = this.getAttribute('data-id');
    const itemElement = this.closest('li');
    const precoText = itemElement.querySelector('small').innerText;
    const precoValor = parseFloat(precoText.replace('R$', '').replace('.', '').replace(',', '.'));

    fetch('remove_item.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + encodeURIComponent(id)
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'ok') {
        // Remove o item da lista
        itemElement.remove();

        // Atualiza o total
        const totalSpan = document.querySelector('.modal-body .fw-bold span');
        if (totalSpan) {
          let totalAtual = parseFloat(totalSpan.innerText.replace('R$', '').replace('.', '').replace(',', '.'));
          let novoTotal = totalAtual - precoValor;
          if (novoTotal < 0) novoTotal = 0;
          totalSpan.innerText = 'R$ ' + novoTotal.toFixed(2).replace('.', ',');
        }

        // Se não houver mais itens, mostrar mensagem
        const lista = document.querySelector('.modal-body ul');
        if (lista && lista.children.length <= 1) {
          document.querySelector('.modal-body').innerHTML = '<p class="text-center">Ainda não há produtos no carrinho.</p>';
        }
      }
    });
  });
});
</script>
</body>
</html
