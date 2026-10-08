<?php

// importa o arquivo que contém a classe Categoria
require_once __DIR__ . "/../models/categoria.php";

// inicia a sessão para permitir o uso de variáveis de sessão
session_start();

// pega o nome enviado pelo formulário através do método POST
$nome = $_POST['nome'];

// cria um novo objeto da classe Categoria
$categoria = new Categoria();

// seta o nome que veio do front pra dentro do objeto
$categoria->setNome($nome);

// chama o método inserir() da classe Categoria
// internamente o metodo inserir vai usar o nome setado no objeto para enviar ao banco
$categoria->inserir();

// armazena uma mensagem de aviso na sessão
// essa mensagem pode ser exibida na próxima página
$_SESSION['aviso'] = "Categoria inserida com sucesso";

// redireciona o usuário para a página de gerenciamento de categorias
header('Location: /biblioteca/views/categoria/gerenciar_categorias.php');

// encerra a execução do código depois do redirecionamento
exit();
