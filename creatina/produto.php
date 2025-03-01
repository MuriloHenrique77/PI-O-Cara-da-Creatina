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
    <style>
        /* =========================
           ESTILO GERAL DA PÁGINA
        ========================== */
        body {
            background-color: #000000;  /* Fundo preto */
            color: #ffffff;             /* Texto claro */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* =========================
           HERO (DESTAQUE DO PRODUTO)
        ========================== */
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }

        .hero-image img {
            max-width: 100%;
            border-radius: 8px;
        }

        .hero-content {
            background-color: #1c1c1c; /* Cinza-escuro para destacar do fundo preto */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
            width: 100%;
        }

        @media (min-width: 768px) {
            .hero-content {
                width: 55%; /* Para telas maiores, ocupa um pouco mais da largura */
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
            color: #28a745; /* Verde para destacar o valor */
            margin: 20px 0;
        }

        /* Botão "Comprar Agora" (verde) */
        .btn-buy {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-buy:hover {
            background-color: #218838;
        }

        /* =========================
           OUTROS PRODUTOS
        ========================== */
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
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
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
            color: #ffffff;
        }

        .product-card .card-price {
            color: #28a745; 
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        /* Botão "Ver Mais" */
        .btn-view {
            background-color: #ff4c4c;
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-view:hover {
            background-color: #e84343;
        }

        /* Espaço inferior para o footer */
        main {
            padding-bottom: 40px;
        }

        /* =========================
           RESPONSIVIDADE
        ========================== */
        @media (max-width: 767px) {
            .hero-content h1 {
                font-size: 1.6rem;
            }

            .price {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<main class="container">
    <!-- HERO DO PRODUTO -->
    <div class="hero">
        <!-- Imagem do Produto -->
        <div class="hero-image col-12 col-md-5 text-center">
            <img 
                src="<?= htmlspecialchars($produto['imagem']); ?>" 
                alt="<?= htmlspecialchars($produto['nome']); ?>">
        </div>

        <!-- Informações do Produto -->
        <div class="hero-content">
            <h1><?= htmlspecialchars($produto['nome']); ?></h1>
            <p><?= nl2br(htmlspecialchars($produto['descricao'])); ?></p>
            <div class="price">
                R$ <?= number_format($produto['preco'], 2, ',', '.'); ?>
            </div>
            
            <!-- Botão "Comprar Agora" via WhatsApp -->
            <a 
               href="https://wa.me/+5534999758250?text=Opa,%20vim%20pelo%20site%20e%20estou%20precisando%20da%20<?php echo urlencode($produto['nome']); ?>%20"

               class="btn-buy"
               target="_blank"
            >
               Comprar Agora
            </a>
        </div>
    </div>

    <!-- OUTROS PRODUTOS -->
    <section class="section-others">
        <h2>Outros Produtos</h2>
        <div class="row">
            <?php foreach ($outros_produtos as $outro): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <img 
                            src="<?= htmlspecialchars($outro['imagem']); ?>" 
                            alt="<?= htmlspecialchars($outro['nome']); ?>"
                        >
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5><?= htmlspecialchars($outro['nome']); ?></h5>
                            <div class="card-price">
                                R$ <?= number_format($outro['preco'], 2, ',', '.'); ?>
                            </div>
                            <a 
                               href="produto.php?produto_id=<?= $outro['id']; ?>" 
                               class="btn btn-view"
                            >
                               Ver Mais
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include "template/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Agora sim -->
