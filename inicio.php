<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== 'ok') {
    header("Location: login.php");
    exit();
}

echo"
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Início | Studio Pulcherrima</title>
    <link rel='stylesheet' href='style/style.css'>
</head>
<body class='menu-page-body'>


<nav>
    <ul>
        <li><a href='produtos.php'>Nossos Produtos</a></li>
        <li><a href='servicos.php'>Serviços</a></li>
        <li><a href='perfil.php'>Meu Perfil</a></li>
        <li><a href='contato.php'>Fale Conosco</a></li>
        <li><a href='logout.php' class='btn-secondary'>Sair</a></li>
    </ul>
</nav>

<div class='hero-content'>
    <h2 class='main-title'>Clínica de Beleza e Estética</h2>
    <p class='sub-title'>Studio Pulcherrima: Onde a elegância encontra a inovação.</p>
    <p>Conheça os nossos serviços</p>
</div>

</body>
</html>";
?>