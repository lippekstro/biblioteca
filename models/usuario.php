<?php
require_once __DIR__ . "/../configs/conexao.php";

class Usuario
{
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $foto;

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
