<?php
include "DLL.php";
extract($_POST);

$consulta = "SELECT * FROM servicos ORDER BY nome_servico ASC";
$result = banco("localhost","root","060423","pulcherrima_bd", $consulta);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Serviços - Studio Pulcherrima</title>
<link rel="stylesheet" href="style/style.css">
</head>

<body class="menu-page-body"> <nav>
    <ul>
        <li><a href='inicio.php'>Início</a></li>
        <li><a href='produtos.php'>Nossos Produtos</a></li>
        <li><a href='servicos.php'>Serviços</a></li>
        <li><a href='perfil.php'>Meu Perfil</a></li>
        <li><a href='contato.php'>Fale Conosco</a></li>
        <li><a href='logout.php'>Sair</a></li>>
    </ul>
</nav>

<section class='before-after-section'>

    <header class='section-header'>
        <h2>Serviços Disponíveis</h2>
        <p class='sub-title' style='color: var(--color-text-dark);'>Confira nossos procedimentos de beleza e estética.</p>
    </header>

    <div class='visual-grid'> 
    
        <?php
        if($result->num_rows > 0){
        
            while($servico = $result->fetch_assoc()){
                echo "
                <div class='visual-card'>
                                <h3 class='procedure-label'>".$servico['nome_servico']."</h3>
                    
                                <div class='image-wrapper'>
                        <div class='image-container'>
                                                <img src='.jpg' alt='Antes do Procedimento'>
                            <p>ANTES</p>
                        </div>
                        <div class='image-container'>
                                                <img src=''.jpg' alt='Depois do Procedimento'>
                            <p>DEPOIS</p>
                        </div>
                    </div>

                                <div class='service-details' style='padding: 1rem;'>
                        <p><strong>Preço:</strong> R$ ".$servico['preco']."</p>
                        <p><strong>Duração:</strong> ".$servico['duracao']." min</p>
                        <p style='font-size: 0.95rem;'>".$servico['descricao']."</p>

                        <a href='agendar.php?servico_id=".$servico['id_servico']."' class='btn-primary' style='display: block; margin-top: 1rem;'>
                            Agendar
                        </a>
                    </div>
                </div>
                ";
            }

        } else {
            echo "<p style='width:100%; text-align:center'>Nenhum serviço disponível no momento.</p>";
        }
        ?>

    </div> </section> </body>
</html>