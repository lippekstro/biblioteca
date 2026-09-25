<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
?>

<main class="container-centraliza">
    <div class="container-perfil">
        <div class="itens-perfil">
            <p><?= $_SESSION['nome'] ?></p>
            <p><?= $_SESSION['email'] ?></p>
        </div>
        <div class="itens-perfil">
            <?php if ($_SESSION['foto'] == null): ?>
                <img src="/biblioteca/imgs/fotos/generica_perfil.png" alt="">
            <?php else: ?>
                <img src="/biblioteca/imgs/fotos/uploads/<?= $_SESSION['foto'] ?>" alt="">
            <?php endif; ?>
        </div>
        <div class="itens-perfil">
            <a href="/biblioteca/views/categoria/gerenciar_categorias.php" class="link-btn">Gerenciar Categorias</a>
            <a href="/biblioteca/views/livro/gerenciar_livros.php" class="link-btn">Gerenciar Livros</a>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>