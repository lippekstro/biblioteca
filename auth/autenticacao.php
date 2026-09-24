<?php
// importa o arquivo responsável pela conexão com o banco de dados
require_once __DIR__ . "/../configs/conexao.php";

// classe responsável pelas funções de autenticação do usuário
class Autenticacao
{
    // método responsável por realizar o login do usuário
    // recebe o email e a senha informados no formulário de login
    public static function logar($email, $senha)
    {
        // inicia a sessão para permitir o armazenamento de informações do usuário
        session_start();

        // comando SQL responsável por buscar um usuário pelo email
        // :email é um espaço reservado para o email informado
        $sql = "SELECT * FROM usuario WHERE email = :email";

        // chama o método conectar() da classe Conexao
        // cria uma conexão configurada e guarda na variável $conexao
        $conexao = Conexao::conectar();

        // prepara o SQL para executar
        $stmt = $conexao->prepare($sql);

        // coloca o valor de $email no espaço reservado :email
        $stmt->bindValue(':email', $email);

        // executa o comando no banco
        $stmt->execute();

        // pega o resultado encontrado no banco
        // guarda os dados do usuário na variável $usuario
        $usuario = $stmt->fetch();

        // verifica se o usuário foi encontrado
        // e se a senha informada corresponde à senha armazenada no banco
        if ($usuario && password_verify($senha, $usuario['senha'])) {

            // armazena o ID do usuário na sessão
            $_SESSION['id_usuario'] = $usuario['id_usuario'];

            // armazena o nome do usuário na sessão
            $_SESSION['nome'] = $usuario['nome'];

            // armazena o email do usuário na sessão
            $_SESSION['email'] = $usuario['email'];

            // armazena a foto do usuário na sessão
            $_SESSION['foto'] = $usuario['foto'];

            // redireciona o usuário para a página de perfil
            header('Location: /biblioteca/views/usuario/perfil.php');

            // encerra a execução do código
            exit();
        }

        // armazena uma mensagem de aviso na sessão
        $_SESSION['aviso'] = "Email ou Senha Inválidos";

        // redireciona o usuário novamente para a página de login
        header("Location: /biblioteca/views/usuario/login.php");

        // encerra a execução do código
        exit();
    }


    // método responsável por verificar se o usuário está autenticado
    public static function estaAutenticado()
    {
        // inicia a sessão para poder acessar os dados armazenados
        session_start();

        // verifica se existe um ID de usuário armazenado na sessão
        // retorna true se o ID existir e false caso não exista
        return isset($_SESSION['id_usuario']);
    }

    // método responsável por encerrar a sessão do usuário
    public static function logout()
    {
        // inicia a sessão para poder acessar os dados armazenados
        session_start();

        // limpa todos os dados armazenados na sessão
        $_SESSION = [];

        // destrói a sessão atual
        session_destroy();

        // redireciona o usuário para a página de login
        header("Location: /biblioteca/views/usuario/login.php");

        // encerra a execução do código
        exit();
    }

    // método responsável por verificar se o usuário está autenticado
    // utilizado para impedir o acesso de usuários não autenticados
    public static function exigirAutenticacao()
    {
        // chama o método estaAutenticado() para verificar se o usuário está logado
        // o ! significa "não", então o bloco será executado se o usuário não estiver autenticado
        // o self indica que esta chamando um metodo da PROPRIA classe que no caso é o estaAutenticado()
        if (!self::estaAutenticado()) {

            // redireciona o usuário não autenticado para a página de login
            header("Location: /biblioteca/views/usuario/login.php");

            // encerra a execução do código
            exit();
        }
    }
}
