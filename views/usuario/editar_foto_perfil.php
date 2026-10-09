<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
?>

<main class="main-detalhe">
    <form action="/biblioteca/controllers/usuario_edt_foto_controller.php" method="post" enctype="multipart/form-data">
        
        <div class="form-item">
            <label for="foto">Foto de Perfil</label>
            <input type="file" name="foto" id="foto">
        </div>

        <input type="hidden" name="id" value="<?= $_SESSION['id_usuario'] ?>">

        <button type="submit">Atualizar</button>

    </form>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>