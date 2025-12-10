<?php
session_start();//Maria Eduarda Menezes e Julia Assis
extract($_POST);
include "DLL.php"; 


if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== 'ok') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['id_cliente'])) {
    header("Location: inicio.php");
    exit();
}
$id_cliente = $_SESSION['id_cliente'];

if (isset($b4)) {
    
    $consulta = "UPDATE clientes SET nome_cliente = '$nome', data_nascimento = '$data', email = '$email', telefone = '$telefone' WHERE id_cliente = $id_cliente";
        
    // Executa a atualização
   $result = banco("localhost","root","060423","pulcherrima_bd",$consulta);
    
    if ($result) {
        header("Location: perfil.php?success=1");
        exit();
    } else {
        $erro_update = "Erro ao atualizar o perfil.";
    }
}


$consulta = "SELECT nome_cliente, email, telefone, data_nascimento FROM clientes WHERE id_cliente = $id_cliente";

$result = banco("localhost","root","060423","pulcherrima_bd",$consulta);
$nome_cliente = "Cliente";
$exibe = null;

if ($result && $result->num_rows > 0) {
    $exibe = $result->fetch_assoc();
    $nome_cliente = $exibe["nome_cliente"];
} else {
    $nome_cliente = "Usuário Desconhecido"; 
}

echo "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Meu Perfil | Studio Pulcherrima</title>
    <link rel='stylesheet' href='style/style.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
</head>
<body class='menu-page-body'>

<nav>
    <ul>
        <li><a href='inicio.php'>Início</a></li>
        <li><a href='produtos.php'>Nossos Produtos</a></li>
        <li><a href='servicos.php'>Serviços</a></li>
        <li><a href='perfil.php'>Meu Perfil</a></li>
        <li><a href='contato.php'>Fale Conosco</a></li>
        <li><a href='logout.php'>Sair</a></li>
    </ul>
</nav>

<div class='hero-content'>
    <h1 class='main-title'>Bem-vindo(a), <span id='profile-name'>$nome_cliente</span>!</h1>
    <p class='sub-title'>Seu espaço exclusivo para gerenciar agendamentos e histórico de beleza.</p>
</div>

<div class='perfil-container'>";

if (!isset($b3)) { 
    $nome = $exibe["nome_cliente"];
    $email = $exibe["email"];
    $telefone = $exibe["telefone"];
    $data_nascimento = databr($exibe["data_nascimento"]); 

    echo "
    <div class='card-section' align='center'>
        <h2><i class='fa-solid fa-user-circle'></i> Seus Dados Pessoais</h2>
        <div class='dados-pessoais-grid'>
            <div class='data-field'>
                <strong>Nome:</strong> <span>$nome</span>
            </div>
            <div class='data-field'>
                <strong>Email:</strong> <span>$email</span>
            </div>
            <div class='data-field'>
                <strong>Telefone:</strong> <span>$telefone</span>
            </div>
            <div class='data-field'>
                <strong>Nascimento:</strong> <span>$data_nascimento</span>
            </div>
        </div>
        <!-- Formulário para acionar o modo de edição (envia b3) -->
        <form method='POST'> 
            <input type='submit' name='b3' value='Editar Perfil' class='btn-secondary btn-large'>
        </form>
    </div>";

} elseif (isset($b3)) { 
    
    $nome_novo = $exibe["nome_cliente"];
    $email_novo = $exibe["email"];
    $telefone_novo = $exibe["telefone"];
    $data_novo = $exibe["data_nascimento"];
    echo "
    <div class='card-section' align='center'>
        <h2><i class='fa-solid fa-edit'></i> Editar Perfil</h2>
        <form method='POST'>
            <p>
                <label for='nome'>Nome Completo:</label>
                <input type='text' id='nome' name='nome' value='$nome_novo' required><br>
            </p>
            <p>
                <label for='data'>Data de Nascimento:</label>
                <input type='date' id='data' name='data' value='$data_novo'><br>
            </p>
            <p>
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' value='$email_novo' required><br>
            </p>
            <p>
                <label for='telefone'>Telefone:</label>
                <input type='text' id='telefone' name='telefone' value='$telefone_novo'><br>
            </p>
            <p>
                <input type='submit' name='b4' value='Salvar Edição' class='btn-primary btn-large'>
                <input type='submit' name='b5' value='Cancelar' class='btn-secondary btn-large'>
            </p>
        </form>
    </div>";

} else {
    echo "<p>Não foi possível carregar seus dados de perfil.</p>";
}

echo "
</div>

</body>
</html>";
?>