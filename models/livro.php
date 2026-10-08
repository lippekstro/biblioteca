<?php

require_once __DIR__ . "/../configs/conexao.php";

/**
 * Classe responsável por representar e gerenciar os livros.
 *
 * Contém métodos para listar, buscar, inserir, atualizar
 * e excluir livros do banco de dados.
 */
class Livro
{
    private $id_livro;
    private $titulo;
    private $ano_pub;
    private $autor;
    private $resumo;
    private $capa;
    private $categoria;

    /**
     * Inicializa um objeto Livro.
     *
     * Caso um ID seja informado, define o ID do livro
     * e carrega seus dados cadastrados.
     *
     * @param int|false $id ID do livro a ser carregado. 
     * Se não informado, cria um objeto vazio.
     */
    public function __construct($id = false)
    {
        if ($id) {
            $this->setId($id);
            $this->carregar();
        }
    }

    /**
     * Lista todos os livros cadastrados.
     *
     * Retorna os dados dos livros juntamente com o nome
     * da categoria à qual cada livro pertence.
     *
     * @return array Retorna um array associativo contendo os livros.
     */
    public static function listar()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para buscar os livros e suas categorias
            $sql = "SELECT l.*, c.nome FROM livro l JOIN categoria c ON l.id_categoria = c.id_categoria";

            // Prepara a consulta SQL
            $stmt = $conexao->prepare($sql);

            // Executa a consulta
            $stmt->execute();

            // Retorna todos os livros encontrados
            // O PDO está configurado para retornar arrays associativos
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo 'Erro ao listar livros: ' . $e->getMessage();
        }
    }

    /**
     * Busca um livro pelo seu ID.
     *
     * @param int $id ID do livro que será buscado.
     *
     * @return array|false Retorna os dados do livro ou false caso não seja encontrado.
     */
    public static function buscarPorId($id)
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para buscar o livro e o nome da categoria
            $sql = "SELECT livro.*, categoria.nome FROM livro JOIN categoria ON livro.id_categoria = categoria.id_categoria WHERE id_livro = :id";

            // Prepara a consulta SQL
            $stmt = $conexao->prepare($sql);

            // Substitui o parâmetro :id pelo ID recebido
            $stmt->bindValue(':id', $id);

            // Executa a consulta
            $stmt->execute();

            // Retorna o primeiro resultado encontrado
            return $stmt->fetch();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo 'Erro ao buscar o livro: ' . $e->getMessage();
        }
    }

    /**
     * Insere um novo livro no banco de dados.
     *
     *
     * @return void
     */
    public function inserir()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta SQL para inserir o livro
            $sql = "INSERT INTO livro (titulo, ano_pub, autor, resumo, capa, id_categoria) VALUES (:titulo, :ano_pub, :autor, :resumo, :capa, :id_categoria)";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores dos parâmetros da consulta
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':ano_pub', $this->ano_pub);
            $stmt->bindValue(':autor', $this->autor);
            $stmt->bindValue(':resumo', $this->resumo);
            $stmt->bindValue(':capa', $this->capa);
            $stmt->bindValue(':id_categoria', $this->categoria);

            // Executa a inserção
            $stmt->execute();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    /**
     * Exclui um livro do banco de dados.
     *
     *
     * @return void
     */
    public function deletar()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para excluir o livro
            $sql = "DELETE FROM livro WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define o ID do livro que será excluído
            $stmt->bindValue(':id', $this->id_livro);

            // Executa a exclusão
            $stmt->execute();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    /**
     * Carrega os dados de um livro pelo ID.
     *
     * Os dados encontrados são armazenados nos atributos
     * do objeto atual.
     *
     * @param int $id ID do livro que será carregado.
     *
     * @return void
     */
    public function carregar()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para buscar o livro
            $sql = "SELECT * FROM livro WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define o ID do livro
            $stmt->bindValue(':id', $this->id_livro);

            // Executa a consulta
            $stmt->execute();

            // Obtém o resultado da consulta
            // O PDO retorna os dados como array associativo
            $resultado = $stmt->fetch();

            // Verifica se um livro foi encontrado
            if ($resultado) {
                // Preenche os atributos do objeto com os dados encontrados
                $this->titulo = $resultado['titulo'];
                $this->autor = $resultado['autor'];
                $this->ano_pub = $resultado['ano_pub'];
                $this->resumo = $resultado['resumo'];
                $this->capa = $resultado['capa'];
                $this->categoria = $resultado['id_categoria'];
            }
        } catch (PDOException $e) {
            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    /**
     * Atualiza todos os dados de um livro.
     *
     *
     * @return void
     */
    public function atualizar()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para atualizar o livro
            $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, ano_pub = :ano, resumo = :resumo, capa = :capa, id_categoria = :categoria WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores que serão atualizados
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':autor', $this->autor);
            $stmt->bindValue(':ano', $this->ano_pub);
            $stmt->bindValue(':resumo', $this->resumo);
            $stmt->bindValue(':capa', $this->capa);
            $stmt->bindValue(':categoria', $this->categoria);
            $stmt->bindValue(':id', $this->id_livro);

            // Executa a atualização
            $stmt->execute();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    /**
     * Atualiza os dados de um livro sem alterar sua capa.
     *
     *
     * @return void
     */
    public function atualizarSemCapa()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para atualizar o livro sem alterar a capa
            $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, ano_pub = :ano, resumo = :resumo, id_categoria = :categoria WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores que serão atualizados
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':autor', $this->autor);
            $stmt->bindValue(':ano', $this->ano_pub);
            $stmt->bindValue(':resumo', $this->resumo);
            $stmt->bindValue(':categoria', $this->categoria);
            $stmt->bindValue(':id', $this->id_livro);

            // Executa a atualização
            $stmt->execute();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    /**
     * Retorna o ID do livro.
     *
     * @return int ID do livro.
     */
    public function getId()
    {
        return $this->id_livro;
    }

    /**
     * Atribui o ID do livro.
     *
     * @param int $id do livro.
     */
    public function setId($id)
    {
        $this->id_livro = $id;
    }

    /**
     * Retorna o título do livro.
     *
     * @return string Título do livro.
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Atribui o titulo do livro.
     *
     * @param string $titulo do livro.
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Retorna o nome do autor.
     *
     * @return string Nome do autor.
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Atribui o autor do livro.
     *
     * @param string $autor do livro.
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * Retorna o ano de publicação do livro.
     *
     * @return int Ano de publicação.
     */
    public function getAno()
    {
        return $this->ano_pub;
    }

    /**
     * Atribui o ano de lançamento do livro.
     *
     * @param int $ano do livro.
     */
    public function setAno($ano)
    {
        $this->ano_pub = $ano;
    }

    /**
     * Retorna o resumo do livro.
     *
     * @return string Resumo do livro.
     */
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * Atribui o resumo do livro.
     *
     * @param string $resumo do livro.
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;
    }

    /**
     * Retorna o nome do arquivo da capa.
     *
     * @return string|null Nome do arquivo da capa ou null.
     */
    public function getCapa()
    {
        return $this->capa;
    }

    /**
     * Atribui o nome do arquivo com extensão da capa do livro.
     *
     * @param string $capa do livro.
     */
    public function setCapa($capa)
    {
        $this->capa = $capa;
    }

    /**
     * Retorna o ID da categoria do livro.
     *
     * @return int ID da categoria.
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Atribui a categoria do livro.
     *
     * @param int $categoria do livro.
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
}
