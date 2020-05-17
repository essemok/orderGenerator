#!!!ПЕРВЫЙ ЗАПУСК ПРОЕКТА!!!
init:up composer-install permissions

#Штатный запуск проекта
up:
	docker-compose up --build -d

#Завершаем работу
down:
	docker-compose down --remove-orphans

#Доступ в bash
in:
	docker exec -it app bash
#Генерируем необходимые данные (товары и пользователя)
data:
	docker exec app php artisan db:seed --class=DatabaseSeeder


composer-install:
	docker exec -it app composer install

permissions:
	docker exec app chmod -R 777 storage \
	&& docker exec app chmod -R 777 mysqldata \
	&& docker exec app chmod -R 777 bootstrap/cache \
	&& docker exec app chmod -R 755 vendor \
