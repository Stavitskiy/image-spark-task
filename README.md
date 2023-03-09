<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Test task

## Origin request

Микросервис должен принимать запрос на получение информации GET /ip2geo?ip=x.x.x.x и в ответ возвращать JSON с широтой, долготой и названиями страны и города на английском языке.
Если IP адрес не найден, то должен возвращаться пустой ответ с кодом 404.
Для ускорения работы сервис должен кэшировать результаты запросов на 30 минут.
Микросервис должен использовать свою собственную базу данных адресов.
Код хотелось бы увидеть на PHP 7, остальной стек любой.

## Implementation

Немного перефразировал задание. В итоге получилось сделующее:

- раз мы возвращаем JSON, предположим что требовалась реализация некого API
- При отсутствии результата в базе, нужно было возвращать пустой ответ с кодом 404 (HTTP ответ? Page not found?).
Любой запрос по урле вернет JSON с ключем "code", успешный 200, отсутвующий 404. При
успешном кейсе JSON массив так же содержит запрашиваему информацию по ip адресу.
- Хотелось бы сделать кеширование через Redis, но для упрощения деплоя остановился на файловом хранилище.
- Данные по фейковым ip докидываются в базу через миграцию

## Deploy

- clone repository
- composer update
- fill in the data for connecting to the database
- php artisan migrate:fresh --seed

## Test Cases

- http://localhost/api/ip2geo/192.168.1.1 - success 
- http://localhost/api/ip2geo/192.168.1.2 - success 
- http://localhost/api/ip2geo/192.168.1.3 - fail
