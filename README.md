# BIBLIOTECA

Sistema de gerenciamento de uma biblioteca desenvolvido usando PHP puro, MySQL, HTML, CSS e JavaScript.

O projeto permite cadastrar e gerenciar categorias, livros, consultar detalhes, alem de cadastro, login e gerenciamento do perfil de usuarios.

## Requisitos

Para executar o projeto localmente, é necessário ter:

* **XAMPP**;
* **PHP 8 ou superior**;
* **MySQL 5.7 ou superior**;
* **Apache**;
* **Navegador Web Atualizado**

## Como executar o projeto com XAMPP

### 1. Instale o XAMPP

Baixe e instale o XAMPP de acordo com o seu sistema operacional.

Após a instalação, abra o **XAMPP Control Panel**.

### 2. Inicie o Apache e o MySQL

No painel do XAMPP, inicie os serviços:

```text
Apache    → Start
MySQL     → Start
```

Os dois serviços precisam estar em execução para que o sistema funcione corretamente.

### 3. Copie o projeto para a pasta do XAMPP

No Windows, a pasta padrão do XAMPP geralmente é:

```text
C:\xampp\htdocs\
```

Copie a pasta do projeto para dentro dela:

```text
C:\xampp\htdocs\biblioteca\
```

A estrutura deverá ficar semelhante a:

```text
C:\xampp\htdocs\
└── biblioteca/
    ├── auth/
    ├── configs/
    ├── controllers/
    ├── css/
    ├── db/
    ├── imgs/
    ├── js/
    ├── models/
    ├── templates/
    ├── views/
    ├── .env
    ├── .env.example
    ├── .gitignore
    ├── README.md
    └── index.php
```

### 4. Crie o banco de dados

Abra o navegador e acesse:

```text
http://localhost/phpmyadmin
```

No phpMyAdmin:

1. Acesse a aba **SQL**;
2. Abra o arquivo `db/database.sql`;
3. Copie o conteúdo do script;
4. Cole no campo de consulta SQL;
5. Execute o script.

O banco de dados `biblioteca` e suas tabelas serão criados.

### 5. Configure o arquivo `.env`

Na raiz do projeto, crie um arquivo chamado:

```text
.env
```

Utilize como referência o arquivo `.env.example`.

No ambiente padrão do XAMPP, o usuário do MySQL geralmente é `root` e a senha costuma estar vazia, caso você não tenha configurado uma senha manualmente.

> Se o seu MySQL estiver configurado com outra senha, informe-a no campo `DB_PASS`.

### 6. Acesse o sistema

Com o Apache e o MySQL em execução, abra o navegador e acesse:

```text
http://localhost/biblioteca/
```

A página inicial do sistema será carregada.