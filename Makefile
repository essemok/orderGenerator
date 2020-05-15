#!!!ПЕРВЫЙ ЗАПУСК ПРОЕКТА!!!
init:up composer-install permission

#Штатный запуск проекта
up:
	docker-compose up --build -d

#Завершаем работу
down:
	docker-compose down --remove-orphans

#Доступ в bash
in:
	docker exec -it app bash

composer-install:
	docker exec -it app composer install

permission:
	docker exec app chmod -R 775 storage \
	&& docker exec app chmod -R 775 mysqldata \
	&& docker exec app chmod -R 775 bootstrap/cache \
	&& docker exec app chmod -R 755 vendor
