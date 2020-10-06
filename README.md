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

[git]: https://github.com/QALT/api-platform
[docker]: https://github.com/QALT/api-platform
[dockercompose]: https://docs.docker.com/compose/
[gnumake]: https://www.gnu.org/software/make/
