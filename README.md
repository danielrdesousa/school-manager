<p align="center">
<img src="logo-laravel.svg" width="400">
</p>
> ### Laravel application developed for a developer test.

This repo is functionality complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone https://github.com/danielrdesousa/school-manager

Switch to the repo folder

    cd api

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the laravel passport key

    php artisan passport:install
    
Run the database seeder and you're done

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**Commands list**

    git clone https://github.com/danielrdesousa/school-manager
    cd api
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan passport:install
    php artisan db:seed
    php artisan serve

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Run the database seeder and you're done

    php artisan db:seed

***Note¹*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

**Note²** : Run the passport install after migrate:refresh

    php artisan passport:install

## Docker

To install with [Docker](https://www.docker.com), run following commands:

```
    not yet implemented
```

<!-- ```
git clone https://github.com/danielrdesousa/school-manager
cd api
cp .env.example.docker .env
docker run -v $(pwd):/api composer install
cd ./docker
docker-compose up -d
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php artisan passport:install
docker-compose exec php php artisan db:seed
docker-compose exec php php artisan serve --host=0.0.0.0
``` -->

The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## API Specification

```
    not yet implemented
```

<!-- This application adheres to the api specifications set by the [Thinkster](https://github.com/gothinkster) team. This helps mix and match any backend with any other frontend without conflicts.

> [Full API Spec](https://github.com/gothinkster/realworld/tree/master/api)

More information regarding the project can be found here https://github.com/gothinkster/realworld -->

----------

# Code overview

## Dependencies

- [Laravel Passport](https://laravel.com/docs/8.x/passport) - For authentication using JSON Web Tokens

## Folders

- `app/Http/Controllers/Api` - Contains all the api controllers
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file
- `tests` - Contains all the application tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Token           	|

Refer the [api specification](#api-specification) for more info.

----------
 
# Authentication
 
This applications uses `Laravel Passport` to handle authentication. The token is passed with each request using the `Authorization` header with `Token` scheme.Please check the following sources to learn more about Laravel Passport.
 
- https://laravel.com/docs/8.x/passport
- https://github.com/laravel/passport
