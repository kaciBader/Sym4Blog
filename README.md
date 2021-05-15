Sym4Blog
======================================
Un exemple d'application web créant un blog en utilisant Symfony 4.4.8.
Cette app est une reprise de  l'app  de tutorial SymBlog developée en symfony  2 ( http://keiruaprod.fr/symblog-fr/)

Les concepts suivants sont abordés dans cette application

* SwiftMailler : pour l'envoi de mail
* Modele MVC (Model, View, Controlleurs)
	`* Les controlleurs
	`* Les templates (avec Twig)
	`* Le modèle - Doctrine 2
* Migrations
* Datas fixctures
* Validateurs
* Formulaires
* Routage
* Environnements
* Personnalisation des pages d’erreur
* Securité
* Generation de CRUD
* Le cache
* Tests avec PHPUnit

Tutorial Original pour symfony 2 :  http://keiruaprod.fr/symblog-fr/

### Installation
 
```
git clone https://github.com/kaciBader/Sym5Jobeet.git
```

```
Composer install
``` 
### Run 
```
cd Sym4Blog/
php -S localhost:8000 -t public/
```

### Tests
```
cd Sym4Blog/
./bin/phpunit
```