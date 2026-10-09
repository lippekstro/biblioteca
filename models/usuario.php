<?php
require_once __DIR__ . "/../configs/conexao.php";

class Usuario
{
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $foto;

    public function __construct($id = false)
    {
        if ($id) {
            $this->setId($id);
            $this->carregar();
        }
    }

    public function carregar()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para buscar o usuario
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define o ID do usuario
            $stmt->bindValue(':id', $this->id_usuario);

            // Executa a consulta
            $stmt->execute();

            // Obtém o resultado da consulta
            // O PDO retorna os dados como array associativo
            $resultado = $stmt->fetch();

            // Verifica se um usuario foi encontrado
            if ($resultado) {
                // Preenche os atributos do objeto com os dados encontrados
                $this->nome = $resultado['nome'];
                $this->email = $resultado['email'];
                $this->senha = $resultado['senha'];
                $this->foto = $resultado['foto'];
            }
        } catch (PDOException $e) {
            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    public function inserir()
    {
        try {
            // criar conexao
            $conexao = Conexao::conectar();
            // criar o sql
            $sql = "INSERT INTO usuario (nome, email, senha, foto) VALUES (:nome, :email, :senha, :foto);";
            // preparar o sql
            $stmt = $conexao->prepare($sql);
            // substituir os dados depois de preparado
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':foto', $this->foto);
            // executar
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

     public function atualizarFoto()
    {
        try {
            // Obtém uma conexão com o banco de dados
            $conexao = Conexao::conectar();

            // Monta a consulta para atualizar o livro
            $sql = "UPDATE usuario SET foto = :foto WHERE id_usuario = :id";

            // Prepara a consulta
            $stmt = $conexao->prepare($sql);

            // Define os valores que serão atualizados
            $stmt->bindValue(':foto', $this->foto);
            $stmt->bindValue(':id', $this->id_usuario);

            // Executa a atualização
            $stmt->execute();
        } catch (PDOException $e) {

            // Exibe uma mensagem caso ocorra um erro no banco de dados
            echo $e->getMessage();
        }
    }

    public function setId($id)
    {
        $this->id_usuario = $id;
    }

    public function getId()
    {
        return $this->id_usuario;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getFoto()
    {
        return $this->foto;
    }
}
