<?php
// importa o arquivo que contém a classe Autenticacao 
require_once __DIR__ . "/../auth/autenticacao.php";

// chama o método estático logout() da classe Autenticacao 
// realiza o encerramento da sessão do usuário 
Autenticacao::logout();
