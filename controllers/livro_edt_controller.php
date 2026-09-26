<?php
require_once __DIR__ . "/../models/livro.php";
session_start();

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$ano = $_POST['ano'];
$autor = $_POST['autor'];
$resumo = $_POST['resumo'];
$categoria = $_POST['categoria'];

$livro = new Livro();

if (!empty($_FILES['capa']['name'])) {
    $capa = $_FILES['capa'];
    $extensao = strtolower(pathinfo($capa['name'], PATHINFO_EXTENSION));
    $nomedacapa = uniqid() . '.' . $extensao;
    $caminho = __DIR__ . "/../imgs/capas/uploads/" . $nomedacapa;
    move_uploaded_file($capa['tmp_name'], $caminho);
    $livro->atualizar($titulo, $autor, $ano, $resumo, $nomedacapa, $categoria, $id);
} else {
    $livro->atualizarSemCapa($titulo, $autor, $ano, $resumo, $categoria, $id);
}




$_SESSION['aviso'] = "Livro atualizado com sucesso";
header('Location: /biblioteca/views/livro/gerenciar_livros.php');
exit();
