<?php
require_once __DIR__ . "/../configs/conexao.php";

class Livro {
    private $id_livro;
    private $titulo;
    private $ano_pub;
    private $autor;
    private $resumo;
    private $capa;
    private $categoria;


    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT l.*, c.nome FROM livro l JOIN categoria c ON l.id_categoria = c.id_categoria";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Erro ao listar livros: ' . $e->getMessage();
        }
    }

    public static function buscarPorId($id){
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT livro.*, categoria.nome FROM livro JOIN categoria ON livro.id_categoria = categoria.id_categoria WHERE id_livro = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Erro ao buscar o livro: ' . $e->getMessage();
        }
    }

    // metodo para inserir itens
    // faz parte do C (Create) do CRUD
    public function inserir($titulo, $ano, $autor, $resumo, $capa, $categoria)
    {
        // usamos try/catch quando existe possibilidade de erro, principalmente ao usar banco de dados
        // o try é onde tentamos executar o código
        try {
            // chama o método conectar() da classe Conexao
            // cria uma conexão configurada e guarda na variável $conexao
            $conexao = Conexao::conectar();

            // comando SQL responsável por inserir um novo item
            // :nome é um espaço reservado para o valor que será inserido
            $sql = "INSERT INTO livro (titulo, ano_pub, autor, resumo, capa, id_categoria) VALUES (:titulo, :ano_pub, :autor, :resumo, :capa, :id_categoria)";

            // prepara o SQL para executar
            $stmt = $conexao->prepare($sql);

            // coloca o valor no espaço reservado
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':ano_pub', $ano);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':capa', $capa);
            $stmt->bindValue(':id_categoria', $categoria);

            // executa o comando no banco
            $stmt->execute();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }
}