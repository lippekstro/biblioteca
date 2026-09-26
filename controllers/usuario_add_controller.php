<?php

// importa o arquivo que contém a classe Usuario
require_once __DIR__ . "/../models/usuario.php";

// recebe os dados enviados pelo formulário através do método POST
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// transforma a senha em um formato criptografado antes de armazená-la no banco
$senha = password_hash($senha, PASSWORD_DEFAULT);

// verifica se o usuário enviou uma foto
if (!empty($_FILES['foto']['name'])) {

    // pega os dados do arquivo enviado
    $foto = $_FILES['foto'];

    // pega a extensão do arquivo e transforma em letras minúsculas
    $extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

    // cria um nome único para a foto usando o uniqid()
    // mantém a extensão original do arquivo
    $nomedafoto = uniqid() . '.' . $extensao;

    // define o caminho onde a foto será armazenada
    $caminho = __DIR__ . "/../imgs/fotos/uploads/" . $nomedafoto;

    // move a foto enviada para a pasta de uploads
    move_uploaded_file($foto['tmp_name'], $caminho);
} else {

    // define a foto como null caso nenhuma foto tenha sido enviada
    $nomedafoto = null;
}

// cria um novo objeto da classe Usuario
// o objeto será utilizado para chamar o método inserir()
$usuario = new Usuario();

// chama o método inserir() da classe Usuario
// envia o nome, email, senha e foto para serem cadastrados no banco
$usuario->inserir($nome, $email, $senha, $nomedafoto);

// redireciona o usuário para a página de login
header('Location: /biblioteca/views/usuario/login.php');

// encerra a execução do código depois do redirecionamento
exit();
