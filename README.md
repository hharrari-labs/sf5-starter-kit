# Starter - Symfony 5

## 1 - Installation

### Depuis Github
```
git clone https://github.com/hharrari-labs/sf5-starter-kit.git
cd sf5-starter-kit
composer install
yarn install
```

## 2 - Configuration
Créer un fichier `.env.local` :
> N'oubliez pas de modifier avec vos informations.
```dotenv
DATABASE_URL=mysql://root:password@127.0.0.1:3306/db_name
```

## 3 - Génération de la structure
```
composer generate
```

## 4 - Démarer le serveur en local
```
symfony serve
yarn encore dev
```

---------------

## Fonctionnalitées

   - SB ADMIN 2 thème pour l'espace d'administration.
   - CRUD pour les utilisateurs côté administrateur
