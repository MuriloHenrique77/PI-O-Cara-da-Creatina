<?php
session_start();

include "template/header.php";
include "config.php";

// Buscar produtos do banco de dados
$sql = "SELECT * FROM produtos";
$result = mysqli_query($conn, $sql);
$produtos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Cara da Creatina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/21c4f0d2e3.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #000; color: #fff; font-family: Arial, sans-serif; }
        h1 { color: #fff; font-size: 2rem; margin-bottom: 30px; font-weight: bold; }
        .static-image { display: block; max-width: 100%; margin: 0 auto; }
        .product-card {
            background-color: #1c1c1c; color: #fff; border: none; border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255,255,255,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(255,255,255,0.2); }
        .product-card .card-img-top {
            background-color: #dcdcdc; padding: 10px; border-radius: 8px 8px 0 0;
            max-height: 150px; object-fit: contain; width: 100%;
        }
        .product-card .card-body { padding: 10px; }
        .product-card h6 { font-size: 1rem; font-weight: bold; margin: 10px 0; }
        .product-card .price { font-size: 1.2rem; color: #28a745; font-weight: bold; margin-bottom: 15px; }
        .product-card .btn-primary {
            background-color: #ff4c4c; color: #fff; border: none;
            padding: 5px 15px; font-size: 0.875rem; border-radius: 20px;
            transition: background-color 0.3s ease;
        }
        .product-card .btn-primary:hover { background-color: #e84343; }
        .btn-buy {
            background-color: #28a745; color: #fff; border: none;
            padding: 5px 15px; font-size: 0.875rem; border-radius: 20px;
            transition: background-color 0.3s ease; margin-left: 5px;
        }
        .btn-buy:hover { background-color: #218838; }
        .footer { background-color: #111; color: #fff; padding: 20px 0; margin-top: 30px; text-align: center; }
        .footer a { color: #ff4c4c; text-decoration: none; }
        .footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<!-- Banner -->
<img src="img/banner1.png" alt="Banner de destaque" class="static-image">

<!-- Produtos -->
<div class="container">
    <h1 class="text-center my-5">Nossos Produtos</h1>
    <div class="row row-cols-2 row-cols-md-4 g-4">
        <?php foreach ($produtos as $produto): ?>
            <div class="col">
                <div class="card product-card">
                    <a href="produto.php?produto_id=<?= $produto['id']; ?>">
                        <img src="<?= $produto['imagem']; ?>" class="card-img-top" alt="<?= $produto['nome']; ?>">
                    </a>
                    <div class="card-body text-center">
                        <h6 class="card-title"><?= $produto['nome']; ?></h6>
                        <p class="price">R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <a href="produto.php?produto_id=<?= $produto['id']; ?>" class="btn btn-sm btn-primary">Ver Mais</a>
                        <a href="https://wa.me/+5534999758250?text=Opa,%20vim%20pelo%20site%20e%20estou%20precisando%20da%20<?= urlencode($produto['nome']); ?>" class="btn btn-sm btn-buy" target="_blank">Comprar Agora</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

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