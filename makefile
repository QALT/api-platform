.PHONY: start stop restart schema token lint fix

DOCKER_COMPOSE_EXEC_OPTIONS=

ifeq (${CI},true)
	DOCKER_COMPOSE_EXEC_OPTIONS=--user root -T
endif

install:
	docker-compose exec $(DOCKER_COMPOSE_EXEC_OPTIONS) php composer install

start:
	docker-compose up --detach

stop:
	docker-compose down --remove-orphans --volumes --timeout 0

restart: stop start

entity:
	docker-compose exec $(DOCKER_COMPOSE_EXEC_OPTIONS) php php bin/console make:entity

schema:
	docker-compose exec $(DOCKER_COMPOSE_EXEC_OPTIONS) php bin/console d:s:u --force

fixture:
	docker-compose exec $(DOCKER_COMPOSE_EXEC_OPTIONS) php bin/console hautelook:fixtures:load

lint:
	docker-compose exec $(DOCKER_COMPOSE_EXEC_OPTIONS) php vendor/bin/phpcs --standard=PSR12 src

fix:
	docker-compose exec $(DOCKER_COMPOSE_EXEC_OPTIONS) php vendor/bin/phpcbf --standard=PSR12 src
