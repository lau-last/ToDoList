README



# ToDo & Co
Projet 8 de la formation **PHP/Symfony** d'OpenClassrooms : *Améliorez une application existante*

Ce projet a été mis à jour sur Symfony **6.4** et PHP **8.3**
## Installer le projet localement
Pour installer le projet sur votre machine, suivez ces étapes :
- Installez Docker *(via [Docker windows](https://docs.docker.com/desktop/install/windows-install/) ou [Docker mac](https://docs.docker.com/desktop/install/mac-install/))*

### 1) Clonez le projet et installez les dépendances :
> git clone https://github.com/lau-last/ToDoList

> placez vous sur la branche **old-front-phpunit**

> construisez le docker avec la commande **docker-compose up -d**

> **composer install**


### 2) Base de données et jeu de démonstration
Créez la base de données, initialisez le schéma et chargez les données de démonstration :
>php bin/console doctrine:database:create

>php bin/console doctrine:schema:update --force --complete

>php bin/console doctrine:fixtures:load

## Tout est prêt !

### Pour tester l'application

Vous pouvez aller sur :
>localhost:8000

Les comptes utilisateur et administrateur de test sont :
>user1 / Secret123

>admin / Secret123

### Rapport de couverture des tests

Vous pouvez accéder au dernier rapport de couverture des tests généré, en ouvrant (avec un navigateur) le fichier index.html situé dans le dossier :
> ...\public\test-coverage\index.html




