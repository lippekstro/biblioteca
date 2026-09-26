<?php

// classe responsável por criar e configurar a conexão com o banco de dados
class Conexao
{
    // método responsável por realizar a conexão com o banco de dados
    // o static permite chamar o método diretamente pela classe, sem criar um objeto
    public static function conectar()
    {
        // lê as informações de configuração do arquivo .env
        // o __DIR__ representa a pasta onde este arquivo está localizado
        $env = parse_ini_file(__DIR__ . '/../.env');

        // pega o endereço do servidor do banco de dados
        $host = $env['DB_HOST'];

        // pega o nome do banco de dados
        $db = $env['DB_NAME'];

        // pega o usuário utilizado para acessar o banco de dados
        $user = $env['DB_USER'];

        // pega a senha utilizada para acessar o banco de dados
        $pass = $env['DB_PASS'];

        // cria uma nova conexão com o banco de dados usando PDO
        // informa o servidor, o banco de dados e a codificação dos caracteres
        // também utiliza o usuário e a senha definidos no arquivo .env
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

        // configura o PDO para lançar uma exceção caso aconteça algum erro
        // isso permite que os erros sejam tratados pelo try/catch
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // define que os resultados das consultas serão retornados como arrays associativos
        // assim podemos acessar os dados usando o nome da coluna, por exemplo: $resultado['nome']
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // devolve a conexão criada para quem chamou o método
        return $conn;
    }
}
