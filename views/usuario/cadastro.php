<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
?>

<main class="main-detalhe">
    <form action="/biblioteca/controllers/usuario_add_controller.php" method="post" enctype="multipart/form-data">
        <img src="/biblioteca/imgs/logo_sem_fundo.png" alt="" class="logo">

        <div class="form-item">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
        </div>

        <div class="form-item">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="form-item">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
        </div>

        <div class="form-item">
            <label for="foto">Foto de Perfil</label>
            <input type="file" name="foto" id="foto">
        </div>

        <button type="submit">Cadastrar</button>

    </form>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>