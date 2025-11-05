<?php
extract($_POST);

date_default_timezone_set('America/Bahia');
$dataHora = date("d/m/Y H:i:s");

if (!isset($b1) && !isset($b2)) {
    echo "<html>
<head>
  <title>Pulcherrima Login</title>
  <link rel='stylesheet' href='style.css'>
</head>
<body>
  <div class='left'>
    <div class='login-wrapper'>
      <!-- Bloco de texto acima do login -->
      <div class='hero-text'>
        <h1 class='brand-title'>PULCHERRIMA</h1>
        <p class='cta'>Crie Sua Conta Gratuitamente</p>
        <p class='tagline'>Beleza e elegância em cada detalhe — junte-se à Pulcherrima.</p>
        <p class='subtitle-visual'>Explore os recursos que Pulcherrima pode oferecer.</p>
      </div>

      <!-- Formulário de login funcional simples -->
      <form action='loginP.php' method='post'>
        <input type='text' name='user'>
        <input type='password' name='password'>
        <input type='submit' name='b1' value='Cadastrar'>
        <input type='submit' name='b2' value='Entrar'>
      </form>
    </div>
  </div>

  <!-- Lado direito com imagem -->
  <div class='right'></div>
</body>
</html>
";
    exit();
}

$senhaCript = md5($password);
$log = fopen("acessos.log", "a");

if(isset($b1)) {
    $teste = fopen($user, "r");
    if($teste){
        fclose($teste);
        echo "Usuário já existe!";
        fwrite($log, "$dataHora - $user: Tentativa de cadastro, mas já existe\n");
        fclose($log);
        exit();
    }

    $arq = fopen($user, "w");
    fwrite($arq, $senhaCript);
    fclose($arq);

    fwrite($log, "$dataHora - $user: Usuário cadastrado\n");
    fclose($log);
    echo "Usuário $user cadastrado com sucesso!";
    exit();
}

if(isset($b2)) {
    $arq = fopen($user, "r");
    if(!$arq){
        echo "Usuário não cadastrado!";
        fwrite($log, "$dataHora - $user: Tentativa de login, mas usuário não encontrado\n");
        fclose($log);
        exit();
    }

    $senhaSalva = fgets($arq);
    fclose($arq);

    if($senhaCript == $senhaSalva) {
        fwrite($log, "$dataHora - $user: Acesso permitido\n");
        fclose($log);
        $logado = fopen("logado", "w");
        fwrite($logado, $user);
        fclose($logado);
        header("Location: deucerto.php");
        exit();
    } else {
        fwrite($log, "$dataHora - $user: Acesso negado - senha incorreta\n");
        fclose($log);
        echo "Senha incorreta, volte e tente novamente!";
        
        exit();
    }
}
?>
