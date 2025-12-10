<?php
session_start(); //Maria Eduarda Menezes e Julia Assis

echo "
<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fale Conosco | Studio Pulcherrima</title>
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
    <h1 class='main-title'>Fale Conosco</h1>
    <p class='sub-title'>Sua beleza é a nossa prioridade. Use um dos canais abaixo para agendamento ou dúvidas.</p>
</div>

<div class='contato-container' align = center>

    <!-- Coluna 1: Informações de Contato e Localização -->
    <div class='contato-info'>
        <h2>Informações de Contato</h2>
        
        <div class='info-block'>
            <h3>Telefone & WhatsApp</h3>
            <p>(73) 99999 - 9999 (Clique para conversar)</p>
            <a href='https://wa.me/5573999999999' target='_blank' class='btn-secondary btn-small'>Enviar WhatsApp</a>
        </div>

        <div class='info-block'>
            <h3>E-mail para Contato</h3>
            <p>contato@pulcherrima.com</p>
            <a href='mailto:contato@pulcherrima.com' class='btn-secondary btn-small'>Enviar E-mail</a>
        </div>
        
        <div class='info-block'>
            <h3>Horário de Atendimento</h3>
            <p>Segunda a Sexta: 9h às 18h</p>
            <p>Sábados: 9h às 13h</p>
        </div>
        
        <div class='info-block'>
            <h3>Nosso Endereço</h3>
            <p>Rua da ***, 123 - Centro<br>Cidade, Estado - CEP 00000-000</p>
            <div class='map-placeholder'>
                <p>Mapa interativo do Google Maps (Embed)</p>
            </div>
        </div>

        <div class='social-links'>
            <h3>Siga-nos</h3>
            <a href='#' target='_blank'><i class='fab fa-instagram'></i></a>
            <a href='#' target='_blank'><i class='fab fa-facebook-f'></i></a>
            <a href='#' target='_blank'><i class='fab fa-pinterest-p'></i></a>
        </div>

    </div>
</div>

</body>
</html>";
?>