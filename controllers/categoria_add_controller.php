<?php

// importa o arquivo que contém a classe Categoria
require_once __DIR__ . "/../models/categoria.php";

// inicia a sessão para permitir o uso de variáveis de sessão
session_start();

// pega o nome enviado pelo formulário através do método POST
$nome = $_POST['nome'];

// cria um novo objeto da classe Categoria
$categoria = New Categoria();

// chama o método inserir() da classe Categoria
// envia o nome recebido do formulário para ser inserido no banco de dados
$categoria->inserir($nome);

// armazena uma mensagem de aviso na sessão
// essa mensagem pode ser exibida na próxima página
$_SESSION['aviso'] = "Categoria inserida com sucesso";

// redireciona o usuário para a página de gerenciamento de categorias
header('Location: /biblioteca/views/categoria/gerenciar_categorias.php');

// encerra a execução do código depois do redirecionamento
exit();
