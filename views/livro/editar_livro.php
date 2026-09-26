<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
require_once __DIR__ . "/../../models/categoria.php";
require_once __DIR__ . "/../../models/livro.php";

$categorias = Categoria::listar();

$id = $_GET['id'];

$livro = new Livro();
$livro->carregar($id);

?>

<main class="main-detalhe">
    <form action="/biblioteca/controllers/livro_edt_controller.php" method="post" enctype="multipart/form-data">

        <div class="form-item">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" value="<?= $livro->getTitulo() ?>">
        </div>

        <div class="form-item">
            <label for="ano">Ano da Publicacao</label>
            <input type="text" name="ano" id="ano" max="2026" value="<?= $livro->getAno() ?>">
        </div>

        <div class="form-item">
            <label for="autor">Autor</label>
            <input type="text" name="autor" id="autor" value="<?= $livro->getAutor() ?>">
        </div>

        <div class="form-item">
            <label for="resumo">Resumo</label>
            <textarea name="resumo" id="resumo"><?= $livro->getResumo() ?></textarea>
        </div>

        <div class="form-item">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>" <?= $livro->getCategoria() == $cat['id_categoria'] ? 'selected' : '' ?>><?= $cat['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-item">
            <label for="capa">Capa</label>
            <input type="file" name="capa" id="capa">
        </div>

        <input type="hidden" name="id" value="<?= $livro->getId() ?>">

        <button type="submit">Atualizar</button>

    </form>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>