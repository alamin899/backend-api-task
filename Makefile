pull:
	docker-compose pull

stop:
	docker-compose stop

start:
	docker-compose up --detach

destroy:
	docker-compose down --volumes

build:
	docker-compose build

down:
	docker-compose exec -T api_backend_php php artisan down

up:
	docker-compose exec -T api_backend_php php artisan up

optimize:
	docker-compose exec -T api_backend_php php artisan optimize

migrate:
	docker-compose exec -T api_backend_php php artisan migrate --force

composer-update:
	docker-compose exec -T api_backend_php composer update -n -o --no-dev

api-doc-generate:
	docker-compose exec -T api_backend_php php artisan l5-swagger:generate

unused-images-remove:
	docker image prune -af
