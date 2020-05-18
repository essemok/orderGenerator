#!!!ПЕРВЫЙ ЗАПУСК ПРОЕКТА!!!
init:up composer_install copy_env generate_key

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
data: permissions migrations add_data

#Входим в консоль mysql
db:
	docker exec -it mysql mysql -uroot -proot

#Накатываем миграции
migrations:
	docker exec app php artisan migrate

#Добавляем даныне в базу
add_data:
	docker exec app php artisan db:seed --class=DatabaseSeeder

#Устанавливаем зависимости приложения
composer_install:
	docker exec -it app composer install

#Меняем права доступа, которые "подпортил" нам докер
permissions:
	sudo chmod -R 777 storage \
	&& sudo chmod -R 777 mysqldata \
	&& sudo chmod -R 777 bootstrap/cache \
	&& sudo chmod -R 777 vendor \

#Копируем переменные окружения
copy_env:
	cp .env.example .env

#Генерируем ключ Laravel приложения
generate_key:
	docker exec app php artisan key:generate
