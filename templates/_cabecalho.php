<?php
require_once __DIR__ . "/../auth/autenticacao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>

    <link rel="shortcut icon" href="/biblioteca/imgs/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="/biblioteca/css/style.css">

    <script src="/biblioteca/js/script.js" defer></script>

</head>

<body>
    <header>
        <img src="/biblioteca/imgs/logo_sem_fundo.png" alt="" class="logo">

        <nav>
            <a href="/biblioteca/index.php">Inicio</a>
            <?php if (!Autenticacao::estaAutenticado()): ?>
                <a href="/biblioteca/views/usuario/cadastro.php">Cadastre-se</a>
                <a href="/biblioteca/views/usuario/login.php">Entrar</a>
            <?php else: ?>
                <a href="/biblioteca/views/usuario/perfil.php">Perfil</a>
                <a href="/biblioteca/controllers/logout_controller.php">Sair</a>
            <?php endif; ?>
        </nav>
    </header>

    <?php
    require_once __DIR__ . "/_avisos.php";
    ?>