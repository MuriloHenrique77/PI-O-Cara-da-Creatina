<?php
include "template/header.php";
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - O Cara da Creatina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/21c4f0d2e3.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header { text-align: center; padding: 30px 0; }
        header h1 { font-size: 2.8rem; font-weight: bold; margin: 0; }
        main { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        section {
            background-color: #1c1c1c;
            color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        section h2 { font-size: 2rem; margin-bottom: 15px; color: #ffffff; text-align: center; }
        section p, section ul {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #ffffff;
            text-align: justify;
        }
        ul { padding-left: 20px; }
        footer {
            background-color: #111111;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }
        footer a { color: #ff4c4c; text-decoration: none; }
        footer a:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            header h1 { font-size: 2rem; }
            main { padding: 20px; }
            section h2 { font-size: 1.6rem; }
            section p, section ul { font-size: 1rem; }
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