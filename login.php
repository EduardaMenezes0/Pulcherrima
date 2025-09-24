<?php
$current_timezone = date_default_timezone_get();
if (!isset($_POST['b1'])) {
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
     <div class='container'>
        <h1>Acesse sua conta</h1>
        </br>
        <form method='POST'>
            <p>
                <label for='login'>Login:</label>
                <input type='text' id='login' name='Login'><br>
            </p>
            <p>
                <label for='senha'>Senha:</label>
                <input type='password' id='Senha' name='Senha' <br>
            </p>
            <p>
                <input type ='submit' name = 'b1' value = 'Verificar Autenticação'>
            </p>
        </form>
    </div>
    </body>
    </html>";
}
    session_start();
