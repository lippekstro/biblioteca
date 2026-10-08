<?php

// importa o arquivo que contém a classe Categoria
require_once __DIR__ . "/../models/categoria.php";

// inicia a sessão para permitir o uso de variáveis de sessão
session_start();

// pega o ID da categoria enviado pela URL através do método GET
$id = $_GET['id'];

// cria um novo objeto da classe Categoria
$categoria = new Categoria();

// seta o ID que veio do front pra dentro do objeto
$categoria->setId($id);

// chama o método deletar() da classe Categoria
// internamente o metodo deletar vai usar o ID setado no objeto para dizer exatamente o registro a ser deletado
$categoria->deletar();

// armazena uma mensagem de aviso na sessão
// essa mensagem pode ser exibida na próxima página
$_SESSION['aviso'] = "Categoria deletada com sucesso";

// redireciona o usuário para a página de gerenciamento de categorias
header('Location: /biblioteca/views/categoria/gerenciar_categorias.php');

// encerra a execução do código depois do redirecionamento
exit();
