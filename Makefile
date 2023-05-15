start:
	docker-compose up -d

build:
	docker-compose up -d --build

down:
	docker-compose down

stop:
	docker-compose stop

rm:
	docker-compose rm

migrate: start
	docker exec -it arca_app php bin/console doctrine:migrations:migrate --no-interaction

seed: start
	docker exec -it arca_app php bin/console doctrine:fixtures:load --no-interaction

startup: build migrate seed stop