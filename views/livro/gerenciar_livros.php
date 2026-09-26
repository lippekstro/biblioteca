<?php
require_once __DIR__ . "/../../templates/_cabecalho.php";
require_once __DIR__ . "/../../models/livro.php";

$livros = Livro::listar();

?>

<main class="container-centraliza">
    <a href="/biblioteca/views/livro/cadastro_livro.php" class="link-btn">Adicionar Livro</a>
    <table>
        <tr>
            <th>Capa</th>
            <th>Titulo</th>
            <th>Ano</th>
            <th>Categoria</th>
            <th colspan="2">Opções</th>
        </tr>

        <?php foreach ($livros as $l): ?>
            <tr>
                <td>
                    <?php if ($l['capa'] == null): ?>
                        <img src="/biblioteca/imgs/capas/generica.png" alt="">
                    <?php else: ?>
                        <img src="/biblioteca/imgs/capas/uploads/<?= $l['capa'] ?>" alt="">
                    <?php endif; ?>
                </td>

                <td><?= $l['titulo'] ?></td>
                <td><?= $l['ano_pub'] ?></td>
                <td><?= $l['nome'] ?></td>
                <td><a href="/biblioteca/views/livro/editar_livro.php?id=<?= $l['id_livro'] ?>">Editar</a></td>
                <td><a href="/biblioteca/controllers/livro_del_controller.php?id=<?= $l['id_livro'] ?>" onclick="return confirm('Tem certeza que deseja deletar este livro?')">Deletar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php
require_once __DIR__ . "/../../templates/_rodape.php";
?>