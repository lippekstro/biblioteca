<?php
// importacao de arquivos necessarios
require_once __DIR__ . "/../configs/conexao.php";

class Categoria
{
    // declarar os atributos da classe
    // geralmente todas as colunas do banco
    // mas nao é restrito somente a isso, podem haver atributos extras de acordo com a necessidade
    private $id_categoria;
    private $nome;

    // metodo para listagem de todos os itens
    // faz parte do R (Read) do CRUD
    public static function listar()
    {
        // usamos try/catch quando existe possibilidade de erro, principalmente ao usar banco de dados
        // o try é onde tentamos executar o código
        try {
            // chama o método conectar() da classe Conexao
            // cria uma conexão configurada e guarda na variável $conexao
            $conexao = Conexao::conectar();

            // comando SQL responsável pela listagem
            $sql = "SELECT * FROM categoria";

            // prepara o SQL para executar
            $stmt = $conexao->prepare($sql);

            // executa o comando no banco
            $stmt->execute();

            // pega todos os resultados encontrados
            // organiza esses dados em um array
            // devolve os dados para quem chamou o método
            return $stmt->fetchAll();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }

    // metodo para inserir itens
    // faz parte do C (Create) do CRUD
    public function inserir($nome)
    {
        // usamos try/catch quando existe possibilidade de erro, principalmente ao usar banco de dados
        // o try é onde tentamos executar o código
        try {
            // chama o método conectar() da classe Conexao
            // cria uma conexão configurada e guarda na variável $conexao
            $conexao = Conexao::conectar();

            // comando SQL responsável por inserir um novo item
            // :nome é um espaço reservado para o valor que será inserido
            $sql = "INSERT INTO categoria (nome) VALUES (:nome)";

            // prepara o SQL para executar
            $stmt = $conexao->prepare($sql);

            // coloca o valor de $nome no espaço reservado :nome
            $stmt->bindValue(':nome', $nome);

            // executa o comando no banco
            $stmt->execute();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }

    // metodo para deletar itens
    // faz parte do D (Delete) do CRUD
    public function deletar($id)
    {
        // usamos try/catch quando existe possibilidade de erro, principalmente ao usar banco de dados
        // o try é onde tentamos executar o código
        try {
            // chama o método conectar() da classe Conexao
            // cria uma conexão configurada e guarda na variável $conexao
            $conexao = Conexao::conectar();

            // comando SQL responsável por excluir um item
            // :id é um espaço reservado para o ID do item que será excluído
            $sql = "DELETE FROM categoria WHERE id_categoria = :id";

            // prepara o SQL para executar
            $stmt = $conexao->prepare($sql);

            // coloca o valor de $id no espaço reservado :id
            $stmt->bindValue(':id', $id);

            // executa o comando no banco
            $stmt->execute();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }

    // metodo para carregar os dados do item baseado no id
    // faz parte do R (Read) do CRUD
    public function carregar($id)
    {
        // usamos try/catch quando existe possibilidade de erro, principalmente ao usar banco de dados
        // o try é onde tentamos executar o código
        try {
            // chama o método conectar() da classe Conexao
            // cria uma conexão configurada e guarda na variável $conexao
            $conexao = Conexao::conectar();

            // comando SQL responsável por buscar uma categoria pelo seu ID
            // :id é um espaço reservado para o ID da categoria que será buscada
            $sql = "SELECT * FROM categoria WHERE id_categoria = :id";

            // prepara o SQL para executar
            $stmt = $conexao->prepare($sql);

            // coloca o valor de $id no espaço reservado :id
            $stmt->bindValue(':id', $id);

            // executa o comando no banco
            $stmt->execute();

            // pega o resultado encontrado no banco
            // como estamos buscando pelo ID, esperamos apenas um registro
            $resultado = $stmt->fetch();

            // verifica se foi encontrada alguma categoria
            if ($resultado) {
                // coloca o ID encontrado no atributo id_categoria do objeto que chamou o metodo
                $this->id_categoria = $resultado['id_categoria'];

                // coloca o nome encontrado no atributo nome do objeto que chamou o metodo
                $this->nome = $resultado['nome'];
            }
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }

    // metodo para atualizar os dados do item baseado no id
    // faz parte do U (Update) do CRUD
    public function atualizar($nome, $id)
    {
        // usamos try/catch quando existe possibilidade de erro, principalmente ao usar banco de dados
        // o try é onde tentamos executar o código
        try {
            // chama o método conectar() da classe Conexao
            // cria uma conexão configurada e guarda na variável $conexao
            $conexao = Conexao::conectar();

            // comando SQL responsável por atualizar o nome de uma categoria
            // :nome e :id são espaços reservados para os valores que serão utilizados
            $sql = "UPDATE categoria SET nome = :nome WHERE id_categoria = :id";

            // prepara o SQL para executar
            $stmt = $conexao->prepare($sql);

            // coloca o valor de $nome no espaço reservado :nome
            $stmt->bindValue(':nome', $nome);

            // coloca o valor de $id no espaço reservado :id
            $stmt->bindValue(':id', $id);

            // executa o comando no banco
            $stmt->execute();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }





    public function getId()
    {
        return $this->id_categoria;
    }

    public function getNome()
    {
        return $this->nome;
    }
}
