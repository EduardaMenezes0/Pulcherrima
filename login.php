<?php
include "DLL.php"; //Maria Eduarda Menezes e Julia Assis
extract($_POST);
session_start();

date_default_timezone_set('America/Bahia');
$dataHora = date("d/m/Y H:i:s");


if (!isset($b1)) {
    
    $mensagem_status = "";
    if (isset($_GET['erro'])) {
        $mensagem_status = "<p style='color: red; font-weight: 600;'>" . htmlspecialchars($_GET['erro']) . "</p>";
    } elseif (isset($_GET['sucesso'])) {
        $mensagem_status = "<p style='color: green; font-weight: 600;'>" . htmlspecialchars($_GET['sucesso']) . "</p>";
    }
    
    echo "
    <html>
      <head>
        <title>Login | Studio Pulcherrima</title>
        <link rel='stylesheet' href='style/style.css'>
      </head>
      <body class='login-body'>
          <div class='login-wrapper'>
          
          <div class='hero-text'>
            <h1 class='brand-title'>PULCHERRIMA</h1>
            <p class='cta'>Acesse sua conta</p>
            <p class='tagline'>Beleza e elegância em cada detalhe — junte-se à Pulcherrima.</p>
            <p class='subtitle-visual'>Explore os recursos que Pulcherrima pode oferecer.</p>
          </div>

          $mensagem_status
          
          <form action='login.php' method='post'>
            <label for='email'>Email:</label>
            <input type='text' name='user' placeholder='seu.email@exemplo.com' required>
            <label for='senha'>Senha:</label>
            <input type='password' name='password' required>
            <input type='submit' name='b1' value='Entrar' class='btn-primary'>
            <p>
                <a href='cadastro.php'>Não tem cadastro? Cadastre-se aqui.</a>
            </p>
            <p>
            <a href='recuperar_senha.php'>Esqueceu sua senha?</a>
            </p>
          </form>
          </div>
      </body>
    </html>
    ";

}

if (isset($b1)) {
    $email_digitado = $user; 
    $senha_digitada = $password;
    
    $senha_md5_digitada = md5($senha_digitada); 
    
    $consulta = "SELECT id_cliente, senha_cripto FROM Clientes WHERE email = '$email_digitado'";

    $result = banco("localhost","root","060423","pulcherrima_bd",$consulta);
    
    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        $cripto_salvo = $usuario['senha_cripto']; 

      
        if ($senha_md5_digitada === $cripto_salvo) { 
            $_SESSION['id_cliente'] = $usuario['id_cliente'];
            $_SESSION['logado'] = 'ok';
                    
            header("Location: inicio.php"); 
            exit();
                    
        } else {
            $mensagem_erro = "E-mail ou senha incorretos. (Senha inválida)"; 
        }
    } else {
        $mensagem_erro = "E-mail ou senha incorretos. (Usuário não encontrado)"; 
    }
    header("Location: login.php?erro=" . urlencode($mensagem_erro));
    exit();

}
?>