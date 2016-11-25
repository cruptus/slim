# Structure d'un projet Slim 3

Auteur : Elbaz Jérémie

## Pre-requis

- Serveur Web avec le mode rewrite
- PHP7
- Composer

## Installation 

```bash
composer install
```

> ATTENTION : Le serveur web doit pointer sur le dossier public

## Fonctionnalité 

- Routing
- Controllers
- Système de rendu avec Twig
- Erreur 404 
- CSRF
- Database
- Fichier de configuration

## Helper

Pour redefinir les fields dans les models (exemple : Attribut name)
```php 
class User extends Model {
    public function getNameAttribute($value){
        return ucfirst($value); // Retourne le nom en majuscule
    }
}

$user = User::all()->first();
echo $user->name; // Le nom sera en majuscule
```

Pour plus d'information : [Laravel Eloquent](https://laravel.com/docs/5.3/eloquent-mutators "Lien de laravel eloquent")