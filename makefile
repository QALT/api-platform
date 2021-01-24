.PHONY: start stop restart schema token

start:
	docker-compose up --detach

stop:
	docker-compose down --remove-orphans --volumes --timeout 0

restart: stop start

entity:
	docker-compose exec php php bin/console make:entity

schema:
	docker-compose exec php bin/console d:s:u --force

fixture:
	docker-compose exec php bin/console hautelook:fixtures:load
