<?php
// importa o arquivo que contém a classe Autenticacao 
require_once __DIR__ . "/../auth/autenticacao.php";

// pega o e-mail enviado pelo formulário através do método POST 
$email = $_POST['email'];

// pega a senha enviada pelo formulário através do método POST 
$senha = $_POST['senha'];

// chama o método estático logar() da classe Autenticacao 
// envia o e-mail e a senha para realizar a autenticação do usuário 
Autenticacao::logar($email, $senha);
