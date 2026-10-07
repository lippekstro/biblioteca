<?php

require_once __DIR__ . "/../models/livro.php";

session_start();

// coloquei o caminho da pagina para evitar ficar reescrevendo toda hora
$pagina_cadastro = '/biblioteca/views/livro/cadastro_livro.php';

// ==================================================
// TÍTULO
// ==================================================

// Recebe o título e remove espaços das extremidades
$titulo = trim($_POST['titulo'] ?? '');
// Verifica se o título foi preenchido
if ($titulo === '') {
    $_SESSION['aviso'] = "Título é obrigatório";
    header("Location: $pagina_cadastro");
    exit();
}

// ==================================================
// AUTOR
// ==================================================

// Recebe o nome do autor e remove espaços das extremidades
$autor = trim($_POST['autor'] ?? '');
// Verifica se o autor foi preenchido
if ($autor === '') {
    $_SESSION['aviso'] = "Nome do autor é obrigatório";
    header("Location: $pagina_cadastro");
    exit();
}

// ==================================================
// RESUMO
// ==================================================

// Recebe o resumo e remove espaços das extremidades
$resumo = trim($_POST['resumo'] ?? '');
// Verifica se o resumo foi preenchido
if ($resumo === '') {
    $_SESSION['aviso'] = "Resumo é obrigatório";
    header("Location: $pagina_cadastro");
    exit();
}

// ==================================================
// ANO
// ==================================================

// Recebe e valida se o ano é um número inteiro
$ano = filter_var($_POST['ano'] ?? '', FILTER_VALIDATE_INT);
// Verifica se o valor informado é um número inteiro válido
if ($ano === false) {
    $_SESSION['aviso'] = "Valor do ano deve ser um número inteiro";
    header("Location: $pagina_cadastro");
    exit();
}

// ==================================================
// CATEGORIA
// ==================================================

// Recebe e valida se a categoria é um número inteiro
$cat = filter_var($_POST['categoria'] ?? '', FILTER_VALIDATE_INT);
// Verifica se o valor informado é um número inteiro válido
if ($cat === false) {
    $_SESSION['aviso'] = "Valor da categoria deve ser um número inteiro";
    header("Location: $pagina_cadastro");
    exit();
}

// ==================================================
// CAPA
// ==================================================

// Por padrão, o livro não terá capa
$nomedacapa = null;
// Verifica se um arquivo foi enviado
if (isset($_FILES['capa']) && $_FILES['capa']['error'] !== UPLOAD_ERR_NO_FILE) {
    // Verifica se o upload foi concluído corretamente
    if ($_FILES['capa']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['aviso'] = "Erro no envio da imagem";
        header("Location: $pagina_cadastro");
        exit();
    }

    // Define os tipos MIME permitidos
    // Cada tipo MIME possui sua extensão correspondente
    $tipos_permitidos = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif'
    ];

    // Identifica o tipo MIME real do arquivo enviado
    $tipo_arquivo = mime_content_type($_FILES['capa']['tmp_name']);

    // Verifica se o tipo MIME está entre os tipos permitidos
    if (!isset($tipos_permitidos[$tipo_arquivo])) {
        $_SESSION['aviso'] = "Tipo de arquivo inválido";
        header("Location: $pagina_cadastro");
        exit();
    }

    // Verifica se o arquivo possui no máximo 2 MB
    if ($_FILES['capa']['size'] > 2 * 1024 * 1024) {
        $_SESSION['aviso'] = "Imagem deve ter no máximo 2 MB";
        header("Location: $pagina_cadastro");
        exit();
    }

    // Obtém a extensão correspondente ao MIME validado
    $extensao = $tipos_permitidos[$tipo_arquivo];

    // Gera um nome aleatório para evitar conflitos e não confiar no nome original
    $nomedacapa = bin2hex(random_bytes(16)) . '.' . $extensao;

    // Define o caminho onde a imagem será armazenada
    $caminho = __DIR__ . "/../imgs/capas/uploads/" . $nomedacapa;

    // Move o arquivo temporário para o diretório definitivo
    if (!move_uploaded_file($_FILES['capa']['tmp_name'], $caminho)) {
        $_SESSION['aviso'] = "Não foi possível salvar a imagem";
        header("Location: $pagina_cadastro");
        exit();
    }
}

// ==================================================
// INSERÇÃO DO LIVRO
// ==================================================

$livro = new Livro();

$livro->inserir($titulo, $ano, $autor, $resumo, $nomedacapa, $cat);

// Informa que o livro foi cadastrado com sucesso
$_SESSION['aviso'] = "Livro inserido com sucesso";
// Redireciona para a página de gerenciamento dos livros
header('Location: /biblioteca/views/livro/gerenciar_livros.php');
exit();
