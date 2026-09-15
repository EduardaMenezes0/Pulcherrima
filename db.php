<?php
// Conexão com o banco de dados usando PDO e prepared statements,
// para evitar SQL injection (o antigo cadastroE montava a query
// concatenando as variáveis do formulário diretamente na string SQL).

function conectarBanco(): PDO
{
    $config = require __DIR__ . '/config.php';

    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";

    return new PDO($dsn, $config['user'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
