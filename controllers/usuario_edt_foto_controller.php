<?php
require_once __DIR__ . "/../models/usuario.php";
session_start();

$id = $_POST['id'];

$usuario = new Usuario($id);

if (!empty($_FILES['foto']['name'])) {
    $foto = $_FILES['foto'];
    $extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
    $nomedafoto = uniqid() . '.' . $extensao;
    $caminho = __DIR__ . "/../imgs/fotos/uploads/" . $nomedafoto;
    move_uploaded_file($foto['tmp_name'], $caminho);
} else {
    $nomedafoto = "";
}

$usuario->setfoto($nomedafoto);

$usuario->atualizarFoto();

// atualizando em tempo real para a nova foto ja ser exibida dentro do site
// se nao tivesse isso a foto so mudaria quando comecasse uma nova sessao
$_SESSION['foto'] = $nomedafoto;


$_SESSION['aviso'] = "Foto atualizada com sucesso";
header('Location: /biblioteca/views/usuario/perfil.php');
exit();
