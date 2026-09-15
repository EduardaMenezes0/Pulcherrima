<?php
// Configuração de acesso ao banco de dados e a outros dados sensíveis.
//
// Para desenvolvimento local, crie um arquivo "config.local.php" (ele é
// ignorado pelo git, veja o .gitignore) retornando um array no mesmo
// formato deste arquivo, com as suas credenciais reais. Nunca versione
// senhas de banco de dados ou e-mails reais diretamente no código.

if (file_exists(__DIR__ . '/config.local.php')) {
    return require __DIR__ . '/config.local.php';
}

return [
    'host' => 'localhost',
    'dbname' => 'pulcherrima_bd',
    'user' => 'root',
    'password' => '',
    'contato_email' => 'contato@example.com',
];
