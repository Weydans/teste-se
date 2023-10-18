run: down 
	docker-compose up -d --build
	docker-compose exec app composer install
	#docker-compose exec app php vendor/bin/doctrine-migrations migrations:migrate --no-interaction
	docker-compose exec app php bin/doctrine.php orm:info
	make status

down:
	docker-compose down
	make status

status:
	docker-compose ps -a

install:
	cp .env.example .env
	ls .data || mkdir .data
	docker-compose up -d --build

uninstall:
	cd .. && rm -rf teste-se 
