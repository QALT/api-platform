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

token:
	docker-compose exec php sh -c ' \
		set -e \
		apk add openssl \
		mkdir -p config/jwt \
		jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')} \
		echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 \
		echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout \
		setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt \
		setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt \
	'
