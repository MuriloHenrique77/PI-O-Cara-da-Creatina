<?php
include "template/header.php";
include "config.php";


if (isset($_GET['produto_id'])) {
    $produto_id = intval($_GET['produto_id']);

    // Carrega o produto específico
    $sql_produto = "SELECT * FROM produtos WHERE id = ?";
    $stmt_produto = $conn->prepare($sql_produto);
    $stmt_produto->bind_param("i", $produto_id);
    $stmt_produto->execute();
    $result_produto = $stmt_produto->get_result();
    $produto = $result_produto->fetch_assoc();

    if (!$produto) {
        echo "<div class='container mt-5'><h1>Produto não encontrado.</h1></div>";
        include "template/footer.php";
        exit();
    }

    // Adiciona ao carrinho
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_ao_carrinho'])) {
        $id = $produto['id'];
        $nome = $produto['nome'];
        $preco = $produto['preco'];

        $_SESSION['carrinho'][$id] = [
            'id' => $id,
            'nome' => $nome,
            'preco' => $preco
        ];

        // Redireciona para a mesma página sem reenvio do form
        echo "<script>window.location.href='produto.php?produto_id=$id';</script>";
        exit();
        
    }

    // Carrega outros produtos
    $sql_others = "SELECT * FROM produtos WHERE id != ? ORDER BY RAND() LIMIT 4";
    $stmt_others = $conn->prepare($sql_others);
    $stmt_others->bind_param("i", $produto_id);
    $stmt_others->execute();
    $result_others = $stmt_others->get_result();
    $outros_produtos = $result_others->fetch_all(MYSQLI_ASSOC);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produto['nome']); ?> - Detalhes do Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/21c4f0d2e3.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }
        .hero-image img {
            max-width: 100%;
            border-radius: 8px;
        }
        .hero-content {
            background-color: #1c1c1c;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(255,255,255,0.1);
            width: 100%;
        }
        @media (min-width: 768px) {
            .hero-content {
                width: 55%;
            }
        }
        .hero-content h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .hero-content p {
            line-height: 1.6;
        }
        .price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #28a745;
            margin: 20px 0;
        }
        .btn-buy {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-buy:hover {
            background-color: #218838;
        }
        .section-others {
            margin: 60px 0 40px 0;
        }
        .section-others h2 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .product-card {
            background-color: #1c1c1c;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255,255,255,0.1);
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
        }
        .product-card img {
            border-radius: 8px 8px 0 0;
            max-height: 200px;
            object-fit: contain;
            width: 100%;
            background-color: #fff;
        }
        .product-card .card-body {
            padding: 15px;
        }
        .product-card h5 {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
        }
        .product-card .card-price {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        .btn-view {
            background-color: #ff4c4c;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-view:hover {
            background-color: #e84343;
        }
        main {
            padding-bottom: 40px;
        }
        @media (max-width: 767px) {
            .hero-content h1 { font-size: 1.6rem; }
            .price { font-size: 1.2rem; }
        }
    </style>
</head>
<body>

<main class="container">
    <div class="hero">
        <div class="hero-image col-12 col-md-5 text-center">
            <img src="<?= htmlspecialchars($produto['imagem']); ?>" alt="<?= htmlspecialchars($produto['nome']); ?>">
        </div>

        <div class="hero-content">
            <h1><?= htmlspecialchars($produto['nome']); ?></h1>
            <p><?= nl2br(htmlspecialchars($produto['descricao'])); ?></p>
            <div class="price">R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></div>

            <!-- Botão que adiciona ao carrinho -->
            <form method="post">
                <input type="hidden" name="adicionar_ao_carrinho" value="1">
                <button type="submit" class="btn-buy">
                    <i class="fa-solid fa-cart-plus"></i> Adicionar ao Carrinho
                </button>
            </form>
        </div>
    </div>

    <section class="section-others">
        <h2>Outros Produtos</h2>
        <div class="row">
            <?php foreach ($outros_produtos as $outro): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <img src="<?= htmlspecialchars($outro['imagem']); ?>" alt="<?= htmlspecialchars($outro['nome']); ?>">
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5><?= htmlspecialchars($outro['nome']); ?></h5>
                            <div class="card-price">
                                R$ <?= number_format($outro['preco'], 2, ',', '.'); ?>
                            </div>
                            <a href="produto.php?produto_id=<?= $outro['id']; ?>" class="btn btn-view">
                                Ver Mais
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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