# AppMax - Controle de Estoque

# Sobre o projeto

Esse sistema foi criado para atender o desafio de um teste para vaga de (Desenvolvedor(a) Full-Stack Jr).

A aplicação consiste em um controle de estoque, onde é possível cadastrar, editar, baixar estoque e deletar produtos. Contém uma API, para que usuários autenticados possa cadastrar novos produtos e dar baixa no estoque.


## Tela de Login
![Login](https://github.com/KovalskiWeb/appmax/blob/master/assets/login.png)

## Tela de Relatório
![Relatorio](https://github.com/KovalskiWeb/appmax/blob/master/assets/relatorio.png)

## Tela de Listagem de Produtos
![Lista Produtos](https://github.com/KovalskiWeb/appmax/blob/master/assets/lista-produtos.png)

## Tela de Edição de Produto
![Edição Produto](https://github.com/KovalskiWeb/appmax/blob/master/assets/edicao-produto.png)

# Tecnologias utilizadas
## Back end
- PHP 7.4
- Laravel 6.20.44
- Mysql 5.7
- Docker
## Front end
- HTML / CSS / Jquery / SweetAlert 2 / Ajax / Bootstrap 4 / One Ui Bootstrap Admin-430 Template

# Como executar o projeto

## Back end
Pré-requisitos: PHP 7.4 / Laravel 6.20.44 / Mysql 5.7

## Pacote
- Sanctum

```bash
# clonar repositório
git clone https://github.com/KovalskiWeb/appmax

# Usuário padrão para acessar o painel
- E-mail: admin@admin.com.br
- Senha: 123456

# executar
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
```

# Autor

Wesley Kovalski

https://www.linkedin.com/in/wesley-kovalski/
