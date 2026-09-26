<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
?>

<main class="main-detalhe">
    <form action="/biblioteca/controllers/login_controller.php" method="post" enctype="multipart/form-data">

        <div class="form-item">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="form-item">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <img src="/biblioteca/imgs/olho_fechado.png" alt="" id="btn-olho">
        </div>

        <button type="submit">Entrar</button>

        <a href="">Esqueceu a senha?</a>

    </form>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>