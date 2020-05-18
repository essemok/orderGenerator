#!!!ПЕРВЫЙ ЗАПУСК ПРОЕКТА!!!
init:up composer_install permissions copy_env generate_key

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


composer_install:
	docker exec -it app composer install

permissions:
	sudo chmod -R 777 storage \
	&& sudo chmod -R 777 mysqldata \
	&& sudo chmod -R 777 bootstrap/cache \
	&& sudo chmod -R 777 vendor \

copy_env:
	cp .env.example .env

generate_key:
	docker exec app php artisan key:generate


