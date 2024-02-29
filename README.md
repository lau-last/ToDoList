# ToDo & Co
Project 8 from the **PHP/Symfony** training of OpenClassrooms: *Improve an existing application*

This project has been updated to Symfony **7.0** and PHP **8.3**
## Install the Project Locally
To install the project on your machine, follow these steps:
- Install a PHP & MySQL environment *(for example, via [MAMP](https://www.mamp.info/en/downloads/))*
- You can also directly install the project via [DOCKER](https://https://docs.docker.com/get-docker/)
- Install [Composer](https://getcomposer.org/download/)
### 1) Download the project from the symfony-demo branch:
> https://github.com/lau-last/ToDoList/archive/refs/heads/symfony-demo.zip
### 2) If you are using Docker:
> docker-compose up -d
### 2) Install dependencies:
> composer install
### 3) If you are using MAMP change the environment variables in the **.env** file
Modify the database access path, example for MySQL:
>DATABASE_URL="mysql://**db_user**:**db_password**@127.0.0.1:3306/**db_name**?charset=utf8mb4"

### 4) Database and Demo Dataset
Create the database, initialize the schema, and load the demo data:
>php bin/console doctrine:database:create

>php bin/console doctrine:schema:update --force --complete

>php bin/console doctrine:fixtures:load



## Everything is Ready!

### To Test the Application

If you are using MAMP you can start the server like this:
>symfony server:start

The test user and administrator accounts are:
>Laurent / 123 (admin)

>Aurelie / 123 (user)

### Test Coverage Report

You can access the latest generated test coverage report by opening (with a browser) the index.html file located in the folder:
> public\coverage\index.html