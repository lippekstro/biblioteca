<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
require_once __DIR__ . "/../../models/categoria.php";

$id = $_GET['id'];

$categoria = new Categoria;
$categoria->carregar($id);



?>

<main class="main-detalhe">
    <form action="/biblioteca/controllers/categoria_edt_controller.php" method="post" enctype="multipart/form-data">

        <div class="form-item">
            <label for="nome">Nome Da Categoria</label>
            <input type="text" name="nome" id="nome" value="<?= $categoria->getNome() ?>">
        </div>

        <input type="hidden" name="id" value="<?= $categoria->getId() ?>">

        <button type="submit">Atualizar</button>
    </form>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>