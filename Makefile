up:
	docker compose up -d --build

down:
	docker compose down

reset:
	docker compose down -v --rmi local

bash:
	docker compose exec backend bash

composer-install:
	docker compose exec backend composer install

key:
	docker compose exec backend php artisan key:generate

migrate:
	docker compose exec backend php artisan migrate

fresh:
	docker compose exec backend php artisan migrate:fresh

init:
	cp backend/.env.example backend/.env
	make composer-install
	make key
	make migrate