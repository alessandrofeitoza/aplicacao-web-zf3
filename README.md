# Simples Aplicação com ZF3 + Doctrine + JQuery

## Introdução

Aplicação web utilizando Doctrine (MySQL) com uma API Rest bem simples usando ZF3 e consumindo com JQuery

## Instalação usando Composer
Primeiro clone ou baixe o projeto do github:

```bash
$ git clone https://github.com/alessandrofeitoza/aplicacao-web-zf3.git
```

Agora instale as dependências com o composer:

```bash
$ cd path/to/application
$ composer install
```

Feito isso vamos agora iniciar nosso servidor local que rodará em http://localhost:8080/
```bash
$ php -S localhost:8000 -t public
```

## Configurando Banco de Dados

Acesse o arquivo /config/autoload/global.php e altere algumas informações.
```php
  ...
  'params' => [
      'host'     => '127.0.0.1',
      'user'     => '<seu usuario>',
      'password' => '<sua senha>',
      'dbname'   => '<nome do banco>',
  ]
  ...
```

Crie o banco de dados MySQL com o mesmo nome que informou no arquivo global.php

Agora precisará criar as tabelas, já que estamos utilizando o Doctrine basta fazer isso abaixo:
```bash
$ php vendor/bin/doctrine-module orm:schema-tool:create
```

## Criando um usuário
Para acessar a aplicação é necessário ter pelo menos 1 usuário, para isso entre no diretório da aplicação e rode o seguinte comando:
```bash
$ php public/index.php user add email@email.com senha123
```
Ao fazer isso um novo usuário com o email e a senha informada serão criados,


## Rodando a Aplicação
Agora basta acessar o http://localhost:8000 (com o servidor rodando) e utilizar a aplicação.