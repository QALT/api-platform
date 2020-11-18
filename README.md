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
docker-compose exec php sh -c '
    set -u
    apk add openssl
    mkdir -p config/jwt
    jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')}
    echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'
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
