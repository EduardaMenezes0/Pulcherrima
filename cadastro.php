<?php
require __DIR__ . '/db.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $data = $_POST['data'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || $data === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um email válido.';
    } else {
        try {
            $pdo = conectarBanco();

            $verifica = $pdo->prepare('SELECT id FROM clientes WHERE email = :email');
            $verifica->execute(['email' => $email]);

            if ($verifica->fetch()) {
                $erro = 'Já existe uma conta cadastrada com esse email.';
            } else {
                $senhaCripto = password_hash($senha, PASSWORD_DEFAULT);

                $insere = $pdo->prepare(
                    'INSERT INTO clientes (nome_cliente, data_nascimento, email, telefone, senha_cripto)
                     VALUES (:nome, :data, :email, :telefone, :senha)'
                );
                $insere->execute([
                    'nome' => $nome,
                    'data' => $data,
                    'email' => $email,
                    'telefone' => $telefone,
                    'senha' => $senhaCripto,
                ]);

                enviarEmailBoasVindas($email, $nome);

                header('Location: login.php?sucesso=' . urlencode('Cadastro realizado com sucesso! Faça seu login.'));
                exit();
            }
        } catch (PDOException $e) {
            $erro = 'Não foi possível completar o cadastro. Tente novamente mais tarde.';
        }
    }
}

function enviarEmailBoasVindas(string $para, string $nome): void
{
    $config = require __DIR__ . '/config.php';
    $assunto = 'Bem-vindo(a) ao Pulcherrima!';
    $corpo = "Olá, {$nome}!\n\nSeja bem-vindo(a) ao Pulcherrima.\nAproveite nossos serviços!";
    $headers = 'From: ' . $config['contato_email'];

    // mail() depende de um servidor de e-mail configurado no host; uma
    // falha aqui não deve impedir o cadastro em si.
    @mail($para, $assunto, $corpo, $headers);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulcherrima — Cadastre-se</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pagina">
        <div class="coluna-visual">
            <h1 class="brand-title">PULCHERRIMA</h1>
            <p class="tagline">Beleza e elegância em cada detalhe — junte-se à Pulcherrima.</p>
        </div>
        <div class="coluna-formulario">
            <div class="cartao">
                <h2>Crie sua conta</h2>

                <?php if ($erro): ?>
                    <p class="mensagem mensagem-erro"><?= htmlspecialchars($erro) ?></p>
                <?php endif; ?>

                <form method="post">
                    <div class="campo">
                        <label for="nome">Nome completo</label>
                        <input type="text" id="nome" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label for="data">Data de nascimento</label>
                        <input type="date" id="data" name="data" required value="<?= htmlspecialchars($_POST['data'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" placeholder="(xx) xxxxx-xxxx" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="botao">Criar conta</button>
                </form>

                <p class="rodape-link">Já tem conta? <a href="login.php">Entrar</a></p>
            </div>
        </div>
    </div>
</body>
</html>
