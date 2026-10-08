<?php
require_once __DIR__ . "/../models/livro.php";
session_start();

$id = $_GET['id'];

$livro = new Livro();
$livro->setId($id);
$livro->deletar();

$_SESSION['aviso'] = "Livro deletada com sucesso";
header('Location: /biblioteca/views/livro/gerenciar_livros.php');
exit();
