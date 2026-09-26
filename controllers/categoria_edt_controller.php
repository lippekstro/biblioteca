<?php
// importa o arquivo que contém a classe Categoria 
require_once __DIR__ . "/../models/categoria.php";

// inicia a sessão para permitir o uso de variáveis de sessão 
session_start();

// pega o nome da categoria enviado pelo formulário através do método POST 
$nome = $_POST['nome'];

// pega o ID da categoria enviado pelo formulário através do método POST 
$id = $_POST['id'];

// cria um novo objeto da classe Categoria 
$categoria = new Categoria();

// chama o método atualizar() da classe Categoria 
// envia o nome e o ID da categoria para identificar qual registro será atualizado 
$categoria->atualizar($nome, $id);

// armazena uma mensagem de aviso na sessão 
// essa mensagem pode ser exibida na próxima página 
$_SESSION['aviso'] = "Categoria atualizada com sucesso";

// redireciona o usuário para a página de gerenciamento de categorias 
header('Location: /biblioteca/views/categoria/gerenciar_categorias.php');

// encerra a execução do código depois do redirecionamento 
exit();
