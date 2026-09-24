<?php
require_once __DIR__ . "/../models/categoria.php";
session_start();

$nome = $_POST['nome'];
$id = $_POST['id'];

$categoria = new Categoria();
$categoria->atualizar($nome, $id);

$_SESSION['aviso'] = "Categoria atualizada com sucesso";
header('Location: /biblioteca/views/categoria/gerenciar_categorias.php');
exit();

