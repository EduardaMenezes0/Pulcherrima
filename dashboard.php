<?php
session_start();

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulcherrima — Minha conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pagina">
        <div class="coluna-visual">
            <h1 class="brand-title">PULCHERRIMA</h1>
            <p class="tagline">Que bom ter você aqui.</p>
        </div>
        <div class="coluna-formulario">
            <div class="cartao">
                <h2>Olá, <?= htmlspecialchars($_SESSION['cliente_nome']) ?>!</h2>
                <p>Seu login foi realizado com sucesso.</p>
                <p><a href="servicos.html">Ver serviços</a></p>
                <form method="post" action="logout.php">
                    <button type="submit" class="botao botao-secundario">Sair</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
