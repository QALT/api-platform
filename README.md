# api-platform

## Requirements

- [Git][git]
- [Docker][docker]
- [Docker Compose][dockercompose]
- [GNU/Make][gnumake]

## Installation

```console
$ git clone git@github.com:QALT/api-platform ~/github.com/QALT/api-platform
$ cd ~/github.com/QALT/api-platform
```

## Environment setup

*Update the environment, especially those with a `!ChangeMe!` value.*

```console
$ cp .env .env.local
$ $EDITOR .env.local
```

*Where `$EDITOR` is the command to open your text editor.*

## Commands

Commands | Alias | Description
---|---|---
`make start` | `make` | Start the Docker Compose services.
`make stop` | N/A. | Stop the Docker Compose services.
`make restart` | N/A. | Restart the Docker Compose services.

## Schema

```console
$ make schema
```

## Composer

```console
$ docker-compose exec php composer COMMAND
```

*Where `COMMAND` is a `composer` command.*

## Symfony

```console
$ docker-compose exec php bin/console COMMAND
```

*Where `COMMAND` is a `composer` command.*

## Token

```console
$ mkdir ./api/config/jwt
$ cat .env # Copy the JWT_PASSPHRASE to your clipboard
$ openssl genrsa -out api/config/jwt/private.pem -aes256 4096 # enter and confirm the JWT_passphrase in .env
$ openssl rsa -pubout -in api/config/jwt/private.pem -out api/config/jwt/public.pem
```

## Endpoints

Endpoint | Description
---|---
[`http://localhost:8081`](http://localhost:8081) | Adminer
[`https://localhost:8443/api/docs`](https://localhost:8443/api/docs) | Docs


[git]: https://github.com/QALT/api-platform
[docker]: https://github.com/QALT/api-platform
[dockercompose]: https://docs.docker.com/compose/
[gnumake]: https://www.gnu.org/software/make/

## Fixture
docker-compose exec php bin/console hautelook:fixtures:load