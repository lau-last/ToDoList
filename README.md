# ToDo & Co

Project 8 from the **PHP/Symfony** training of OpenClassrooms: *Improve an existing application*

This project has been updated to Symfony **7.0** and PHP **8.3**

## Install the Project Locally

To install the project on your machine, follow these steps:

- Install a PHP & MySQL environment *(for example, via [MAMP](https://www.mamp.info/en/downloads/))*
- You can also directly install the project via [DOCKER](https://https://docs.docker.com/get-docker/)
- Install [Composer](https://getcomposer.org/download/)
- Install [Symfony-CLI](https://symfony.com/download)

### 1) Clone the project and install the dependencies:

> git clone https://github.com/lau-last/ToDoList.git

### 2) If you are using Docker:

> docker-compose up -d

### 2) Install dependencies:

> composer install

### 3) If you are using MAMP change the environment variables in the **.env** file

Modify the database access path, example for MySQL:
> DATABASE_URL="mysql://**db_user**:**db_password**@127.0.0.1:3306/**db_name**?charset=utf8mb4"

### 4) Database and Demo Dataset

Create the database, initialize the schema, and load the demo data:
> php bin/console doctrine:database:create

> php bin/console doctrine:schema:update --force --complete

> php bin/console doctrine:fixtures:load

## Everything is Ready!

### To Test the Application

If you are using MAMP you can start the server like this:
> symfony server:start


If you are using Docker, there is no need to run the symfony server:start command, as the Docker container is configured to automatically launch this command on startup.


The test user and administrator accounts are:
> Laurent / 123 (admin)

> Aurelie / 123 (user)

### Test Coverage Report

You can access the latest generated test coverage report by opening (with a browser) the index.html file located in the
folder:
> public\coverage\index.html

Certainly, here is the same contribution guide translated into English:

# Contributing to the Project

Thank you for considering contributing! Here's how to do it:

## Quick Steps

1. **Fork**: Click on `Fork` at the top right of the project's GitHub page to create a copy on your account.

2. **Clone**: Clone your fork to your local machine with `git clone URL_OF_YOUR_FORK`.

3. **Branch**: Create a new branch for your changes with `git checkout -b name-of-your-branch`.

4. **Modify**: Make your changes.

5. **Commit**: Add your files with `git add .` and then commit with `git commit -m "your message"`.

6. **Push**: Push your changes to GitHub with `git push origin name-of-your-branch`.

7. **Pull Request**: On GitHub, go to the original repository and click on `Compare & pull request` to submit your
   changes.

## Tips

- Look at existing issues to find something to work on.
- Make clear and concise commits.
- Wait for feedback on your Pull Request.

Thank you for your contribution!
