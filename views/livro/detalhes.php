<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
require_once __DIR__ . "/../../models/livro.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $livro = Livro::buscarPorId($id);
} else {
    header("Location: /biblioteca/index.php");
    exit();
}

if (!$livro) {
    header("Location: /biblioteca/index.php");
    exit();
}


?>

<main class="main-detalhe">

    <div id="img-detalhe">
        <?php if ($livro['capa'] == null): ?>
            <img src="/biblioteca/imgs/capas/generica.png" alt="">
        <?php else: ?>
            <img src="/biblioteca/imgs/capas/uploads/<?= $livro['capa'] ?>" alt="">
        <?php endif; ?>
    </div>

    <div id="texto-detalhe">
        <h2><?= $livro['titulo'] ?></h2>
        <br>
        <p><?= $livro['ano_pub'] ?></p>
        <br>
        <p><?= $livro['autor'] ?></p>
        <br>
        <p><?= $livro['nome'] ?></p>
        <br>
        <p><?= $livro['resumo'] ?></p>
    </div>

</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>