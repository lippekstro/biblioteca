<?php
require_once __DIR__ . "/../configs/conexao.php";

class Livro
{
    private $id_livro;
    private $titulo;
    private $ano_pub;
    private $autor;
    private $resumo;
    private $capa;
    private $categoria;


    public static function listar()
    {
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

    public static function buscarPorId($id)
    {
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

    public function inserir($titulo, $ano, $autor, $resumo, $capa, $categoria)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO livro (titulo, ano_pub, autor, resumo, capa, id_categoria) VALUES (:titulo, :ano_pub, :autor, :resumo, :capa, :id_categoria)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':ano_pub', $ano);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':capa', $capa);
            $stmt->bindValue(':id_categoria', $categoria);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($id)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM livro WHERE id_livro = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function carregar($id)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM livro WHERE id_livro = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if ($resultado) {
                $this->id_livro = $resultado['id_livro'];
                $this->titulo = $resultado['titulo'];
                $this->autor = $resultado['autor'];
                $this->ano_pub = $resultado['ano_pub'];
                $this->resumo = $resultado['resumo'];
                $this->capa = $resultado['capa'];
                $this->categoria = $resultado['id_categoria'];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizar($titulo, $autor, $ano, $resumo, $capa, $categoria, $id)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, ano_pub = :ano, resumo = :resumo, capa = :capa, id_categoria = :categoria WHERE id_livro = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':ano', $ano);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':capa', $capa);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizarSemCapa($titulo, $autor, $ano, $resumo, $categoria, $id)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, ano_pub = :ano, resumo = :resumo, id_categoria = :categoria WHERE id_livro = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':ano', $ano);
            $stmt->bindValue(':resumo', $resumo);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId()
    {
        return $this->id_livro;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getAno()
    {
        return $this->ano_pub;
    }

    public function getResumo()
    {
        return $this->resumo;
    }

    public function getCapa()
    {
        return $this->capa;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }
}
