<?php
require_once __DIR__ . "/../models/livro.php";
session_start();

$titulo = $_POST['titulo'];
$ano = $_POST['ano'];
$autor = $_POST['autor'];
$resumo = $_POST['resumo'];
$cat = $_POST['categoria'];

// verifica se o usuário enviou uma foto
if(!empty($_FILES['capa']['name'])) {

    // pega os dados do arquivo enviado
    $capa = $_FILES['capa'];

    // pega a extensão do arquivo e transforma em letras minúsculas
    $extensao = strtolower(pathinfo($capa['name'], PATHINFO_EXTENSION));

    // cria um nome único para a capa usando o uniqid()
    // mantém a extensão original do arquivo
    $nomedacapa = uniqid() . '.' . $extensao;

    // define o caminho onde a capa será armazenada
    $caminho = __DIR__ . "/../imgs/capas/uploads/" . $nomedacapa;

    // move a capa enviada para a pasta de uploads
    move_uploaded_file($capa['tmp_name'], $caminho);

} else {

    // define a capa como null caso nenhuma capa tenha sido enviada
    $nomedacapa = null;
}

$livro = new Livro();
$livro->inserir($titulo, $ano, $autor, $resumo, $nomedacapa, $cat);

$_SESSION['aviso'] = "Livro inserido com sucesso";
header('Location: /biblioteca/views/livro/gerenciar_livros.php');
exit();
