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

    // aqui criei um construtor que pode ou nao receber um id
    // quando ele recebe um id ele ja atribui esse id ao objeto criado
    // lembrando que o construtor roda na criacao de um objeto ex: $categoria = new Categoria();
    // ou seja nosso objeto teria todos os atributos nulos id_categoria = null e nome = null
    // se eu criar o objeto e passar o id ex: $categoria = new Categoria(1);
    // o objeto ja nasce com id_categoria = 1
    // isso serve para objetos que vao representar algum item ja existente no banco de dados
    // ate porque logo em seguida ele chama o carregar(), para puxar o restante das informacoes
    // ou seja, quando nasce ja nasce com id_categoria = 1 e logo em seguida o carregar puxa o restante no caso o nome, baseado nesse id
    // caso nao venha nenhum id, o construtor nao faz nada
    public function __construct($id = false)
    {
        if ($id) {
            $this->setId($id);
            $this->carregar();
        }
    }

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
    public function inserir()
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

            // coloca o valor de $nome do objeto no espaço reservado :nome
            $stmt->bindValue(':nome', $this->nome);

            // executa o comando no banco
            $stmt->execute();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }

    // metodo para deletar itens
    // faz parte do D (Delete) do CRUD
    public function deletar()
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

            // coloca o valor de $id do objeto no espaço reservado :id
            $stmt->bindValue(':id', $this->id_categoria);

            // executa o comando no banco
            $stmt->execute();
        } catch (PDOException $e) { // executa caso aconteça um erro
            // mostra o erro encontrado
            echo $e->getMessage();
        }
    }

    // metodo para carregar os dados do item baseado no id
    // faz parte do R (Read) do CRUD
    public function carregar()
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

            // coloca o valor de $id do objeto no espaço reservado :id
            $stmt->bindValue(':id', $this->id_categoria);

            // executa o comando no banco
            $stmt->execute();

            // pega o resultado encontrado no banco
            // como estamos buscando pelo ID, esperamos apenas um registro
            $resultado = $stmt->fetch();

            // verifica se foi encontrada alguma categoria
            if ($resultado) {
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
    public function atualizar()
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

            // coloca o valor de $nome do objeto no espaço reservado :nome
            $stmt->bindValue(':nome', $this->nome);

            // coloca o valor de $id do objeto no espaço reservado :id
            $stmt->bindValue(':id', $this->id_categoria);

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

    public function setId($id)
    {
        $this->id_categoria = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}
