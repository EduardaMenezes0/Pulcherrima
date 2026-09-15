<?php
session_start();
require __DIR__ . '/db.php';

$erro = null;
$sucesso = $_GET['sucesso'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Informe email e senha.';
    } else {
        try {
            $pdo = conectarBanco();
            $consulta = $pdo->prepare('SELECT id, nome_cliente, senha_cripto FROM clientes WHERE email = :email');
            $consulta->execute(['email' => $email]);
            $cliente = $consulta->fetch();

            if ($cliente && password_verify($senha, $cliente['senha_cripto'])) {
                session_regenerate_id(true);
                $_SESSION['cliente_id'] = $cliente['id'];
                $_SESSION['cliente_nome'] = $cliente['nome_cliente'];
                header('Location: dashboard.php');
                exit();
            }

            $erro = 'Email ou senha incorretos.';
        } catch (PDOException $e) {
            $erro = 'Não foi possível fazer login. Tente novamente mais tarde.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulcherrima — Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pagina">
        <div class="coluna-visual">
            <h1 class="brand-title">PULCHERRIMA</h1>
            <p class="tagline">Explore os recursos que Pulcherrima pode oferecer.</p>
        </div>
        <div class="coluna-formulario">
            <div class="cartao">
                <h2>Acesse sua conta</h2>

                <?php if ($sucesso): ?>
                    <p class="mensagem mensagem-sucesso"><?= htmlspecialchars($sucesso) ?></p>
                <?php endif; ?>
                <?php if ($erro): ?>
                    <p class="mensagem mensagem-erro"><?= htmlspecialchars($erro) ?></p>
                <?php endif; ?>

                <form method="post">
                    <div class="campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="botao">Entrar</button>
                </form>

                <p class="rodape-link">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>
        </div>
    </div>
</body>
</html>
