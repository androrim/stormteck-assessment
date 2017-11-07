# Stormteck Assessment - Books Filtering

Sistema desenvolvido com o Framework Symfony 3.x (http://symfony.com/) por Leandro de Amorim <androrim@gmail.com>

## Instalação

### Faça o download ou clone o projeto

* Em seu ambiente de desenvolvimento execute o seguinte comando:
```sh
$ git clone git@github.com:androrim/stormteck-assessment.git [nome_do_projeto]
```

* Na raiz deste projeto execute os seguintes comandos:

```sh
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec php /var/www/bin/console doctrine:database:create --if-not-exists
$ docker-compose exec php /var/www/bin/console doctrine:schema:update --force
```

## Acessando a aplicação

A aplicação será exposta na porta 80 de seu Sistema Operacional, ou seja, 
caso seja local, http://localhost (http://localhost) será o suficiente. 