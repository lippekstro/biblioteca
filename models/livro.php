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
     * @param string $titulo Título do livro.
     * @param int $ano Ano de publicação do livro.
     * @param string $autor Nome do autor do livro.
     * @param string $resumo Resumo do livro.
     * @param string|null $capa Nome do arquivo da capa ou null caso não possua capa.
     * @param int $categoria ID da categoria do livro.
     *
     * @return void
     */
    public function inserir($titulo, $ano, $autor, $resumo, $capa, $categoria) {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta SQL para inserir o livro
            $sql = "INSERT INTO livro (titulo, ano_pub, autor, resumo, capa, id_categoria) VALUES (:titulo, :ano_pub, :autor, :resumo, :capa, :id_categoria)";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores dos parâmetros da consulta
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':ano_pub', $ano);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':capa', $capa);
            $stmt->bindValue(':id_categoria', $categoria);

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
     * @param int $id ID do livro que será excluído.
     *
     * @return void
     */
    public function deletar($id)
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para excluir o livro
            $sql = "DELETE FROM livro WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define o ID do livro que será excluído
            $stmt->bindValue(':id', $id);

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
    public function carregar($id)
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para buscar o livro
            $sql = "SELECT * FROM livro WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define o ID do livro
            $stmt->bindValue(':id', $id);

            // Executa a consulta
            $stmt->execute();

            // Obtém o resultado da consulta
            // O PDO retorna os dados como array associativo
            $resultado = $stmt->fetch();

            // Verifica se um livro foi encontrado
            if ($resultado) {
                // Preenche os atributos do objeto com os dados encontrados
                $this->id_livro = $resultado['id_livro'];
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
     * @param string $titulo Novo título do livro.
     * @param string $autor Novo nome do autor.
     * @param int $ano Novo ano de publicação.
     * @param string $resumo Novo resumo do livro.
     * @param string|null $capa Nome do novo arquivo da capa ou null.
     * @param int $categoria Novo ID da categoria.
     * @param int $id ID do livro que será atualizado.
     *
     * @return void
     */
    public function atualizar($titulo, $autor, $ano, $resumo, $capa, $categoria, $id) {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para atualizar o livro
            $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, ano_pub = :ano, resumo = :resumo, capa = :capa, id_categoria = :categoria WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores que serão atualizados
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':ano', $ano);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':capa', $capa);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':id', $id);

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
     * @param string $titulo Novo título do livro.
     * @param string $autor Novo nome do autor.
     * @param int $ano Novo ano de publicação.
     * @param string $resumo Novo resumo do livro.
     * @param int $categoria Novo ID da categoria.
     * @param int $id ID do livro que será atualizado.
     *
     * @return void
     */
    public function atualizarSemCapa($titulo, $autor, $ano, $resumo, $categoria, $id) {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para atualizar o livro sem alterar a capa
            $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, ano_pub = :ano, resumo = :resumo, id_categoria = :categoria WHERE id_livro = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores que serão atualizados
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':ano', $ano);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':id', $id);

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
     * Retorna o título do livro.
     *
     * @return string Título do livro.
     */
    public function getTitulo()
    {
        return $this->titulo;
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
     * Retorna o ano de publicação do livro.
     *
     * @return int Ano de publicação.
     */
    public function getAno()
    {
        return $this->ano_pub;
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
     * Retorna o nome do arquivo da capa.
     *
     * @return string|null Nome do arquivo da capa ou null.
     */
    public function getCapa()
    {
        return $this->capa;
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
}
