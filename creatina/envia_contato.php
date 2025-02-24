<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Pega os valores dos campos
    $nome     = isset($_POST['nome'])     ? trim($_POST['nome'])     : '';
    $email    = isset($_POST['email'])    ? trim($_POST['email'])    : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';

    // Ajuste aqui para o seu e-mail de destino
    $destinatario = "seuemail@seudominio.com";

    // Assunto do e-mail
    $assunto = "Novo contato do site - " . $nome;

    // Corpo do e-mail
    $corpo = "Nome: $nome\n"
           . "E-mail: $email\n"
           . "----------------------------------\n"
           . "Mensagem:\n$mensagem\n";

    // Cabeçalhos (opcionais, mas recomendados)
    // Deixa o e-mail do remetente no "From" e também no "Reply-To"
    $headers = "From: $email\r\n"
             . "Reply-To: $email\r\n"
             . "X-Mailer: PHP/" . phpversion();

    // Função mail() - envia o e-mail
    // Importante: verifique se o seu servidor tem o envio de emails habilitado
    if (mail($destinatario, $assunto, $corpo, $headers)) {
        // Se o envio funcionar, pode redirecionar de volta com mensagem de sucesso
        header("Location: contato.php?envio=sucesso");
        exit;
    } else {
        // Caso haja erro no envio, redireciona informando erro
        header("Location: contato.php?envio=erro");
        exit;
    }
} else {
    // Se alguém acessar diretamente via GET, redirecionamos para o formulário
    header("Location: contato.php");
    exit;
}
