<?php
require_once __DIR__ . "/../models/livro.php";
session_start();

$id = $_GET['id'];

$livro = new Livro();
$livro->deletar($id);

$_SESSION['aviso'] = "Livro deletada com sucesso";
header('Location: /biblioteca/views/livro/gerenciar_livros.php');
exit();
