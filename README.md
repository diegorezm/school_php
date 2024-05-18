# School Laravel Project
[documentation](https://github.com/diegorezm/school_php/tree/main/docs/README.md)


This project is a rewrite of a previous [Java project](https://github.com/diegorezm/school_java) aimed at exploring the Laravel PHP framework. 
It serves as a REST API for managing school data, currently focused on student information.
The API allows filtering students based on specific criteria. You can potentially filter by name, or other relevant attributes.
## Setup
### Clone the repository
```bash
git clone https://github.com/diegorezm/school_php
```
### Setup project
- install Dependencies
```bash
composer install
```
### Setup the database 
```bash
cp .env.exemple .env && sudo docker-compose up -d && php artisan migrate
```
### Run
```bash
php artisan serve
```
## Todo
- [] Bulk store
