<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
require_once __DIR__ . "/../../models/categoria.php";

$categorias = Categoria::listar();
?>

<main class="main-detalhe">
    <form action="/biblioteca/controllers/livro_add_controller.php" method="post" enctype="multipart/form-data">

        <div class="form-item">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo">
        </div>

        <div class="form-item">
            <label for="ano">Ano da Publicacao</label>
            <input type="text" name="ano" id="ano" max="2026">
        </div>

        <div class="form-item">
            <label for="autor">Autor</label>
            <input type="text" name="autor" id="autor">
        </div>

        <div class="form-item">
            <label for="resumo">Resumo</label>
            <textarea name="resumo" id="resumo"></textarea>
        </div>

        <div class="form-item">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-item">
            <label for="capa">Capa</label>
            <input type="file" name="capa" id="capa">
        </div>

        <button type="submit">Cadastrar</button>

    </form>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>