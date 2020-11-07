.PHONY: start stop restart

start:
	docker-compose up --detach

stop:
	docker-compose down --remove-orphans --volumes --timeout 0

restart: stop start

entity:
	docker-compose exec php php bin/console make:entity
