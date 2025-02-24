<?php
include "template/header.php";
include "config.php";

// Adicionar produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['imagem']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $descricao, $preco, $target_file);
        $stmt->execute();
        $stmt->close();
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
}

// Editar produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['imagem']['name'];

    if (!empty($imagem)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);

        $stmt = $conn->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nome, $descricao, $preco, $target_file, $id);
    } else {
        $stmt = $conn->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nome, $descricao, $preco, $id);
    }

    $stmt->execute();
    $stmt->close();
    echo "Produto atualizado com sucesso!";
}

// Remover produto
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    echo "Produto removido com sucesso!";
}

// Buscar produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
$produtos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Gerenciar Produtos</h1>
        
        <!-- Formulário para adicionar produto -->
        <form method="POST" action="" enctype="multipart/form-data" class="my-4">
            <h3>Adicionar Produto</h3>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" required>
            </div>
            <button type="submit" name="add_product" class="btn btn-success">Adicionar</button>
        </form>

        <!-- Tabela de produtos -->
        <h3>Lista de Produtos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['descricao']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><img src="<?php echo $produto['imagem']; ?>" alt="Imagem do produto" style="max-width: 100px;"></td>
                        <td>
                            <form method="POST" action="" enctype="multipart/form-data" class="mb-2">
                                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                                <input type="text" name="nome" class="form-control mb-2" value="<?php echo $produto['nome']; ?>" required>
                                <textarea name="descricao" class="form-control mb-2" required><?php echo $produto['descricao']; ?></textarea>
                                <input type="number" name="preco" class="form-control mb-2" step="0.01" value="<?php echo $produto['preco']; ?>" required>
                                <input type="file" name="imagem" class="form-control mb-2">
                                <button type="submit" name="edit_product" class="btn btn-warning">Editar</button>
                            </form>
                            <a href="?delete=<?php echo $produto['id']; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
