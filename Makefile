build:
	@docker-compose build
start:
	@docker-compose up
stop:
	@docker-compose stop
restart:
	@docker-compose restart
down:
	@docker-compose down
clear:
	@docker-compose exec app php artisan o:c
migrate:
	@docker-compose exec app php artisan migrate
migrate-concrete:
	@docker-compose exec app php artisan migrate --path=/database/migrations/$(name)
seed:
	@docker-compose exec app php artisan db:seed
make-migration:
	@docker-compose exec app php artisan make:migration $(name)
make-seed:
	@docker-compose exec app php artisan make:seed $(name)
composer-install:
	@docker exec -it wb-app bash -c "composer install"
key-generate:
	@docker exec -it wb-app bash -c "php artisan key:generate"
composer-update:
	@docker exec -it wb-app bash -c "composer update"
storage-link:
	@docker exec -it wb-app bash -c "php artisan storage:link"

