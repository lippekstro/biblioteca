<?php
require_once __DIR__ . "/../models/livro.php";
session_start();

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$ano = $_POST['ano'];
$autor = $_POST['autor'];
$resumo = $_POST['resumo'];
$categoria = $_POST['categoria'];

$livro = new Livro($id);
$livro->setTitulo($titulo);
$livro->setAno($ano);
$livro->setAutor($autor);
$livro->setResumo($resumo);
$livro->setCategoria($categoria);

if (!empty($_FILES['capa']['name'])) {
    $capa = $_FILES['capa'];
    $extensao = strtolower(pathinfo($capa['name'], PATHINFO_EXTENSION));
    $nomedacapa = uniqid() . '.' . $extensao;
    $caminho = __DIR__ . "/../imgs/capas/uploads/" . $nomedacapa;
    move_uploaded_file($capa['tmp_name'], $caminho);
    $livro->setCapa($nomedacapa);
    $livro->atualizar();
} else {
    $livro->atualizarSemCapa();
}




$_SESSION['aviso'] = "Livro atualizado com sucesso";
header('Location: /biblioteca/views/livro/gerenciar_livros.php');
exit();
