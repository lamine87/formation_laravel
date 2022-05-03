<!-- # formation_laravel
laravel new nom_du dossier (ou) composer create-project --prefer-dist laravel/laravel Demo

database tool (Extension pour afficher la base de données dans phpstorm) 

php artisan key:generate (clé de sécurité dans .env)

php artisan make:controller Shop/MainController (Creer un controller)
 
php artisan make:controller Api\AuthController (Creer un controller d'API)

php artisan make:controller backend/CategorieController

php artisan make:model Categorie -m

php artisan make:provider RiakServiceProvider (Creer un Model dans Provider)
 
composer require intervention/image

mysql -u root -p

php artisan serve

CREATE DATABASE promo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

exit (pour sortir)cd

composer dump-autoload (Pour le begue de container.php)

php artisan cache:clear  (Pour vider le cache)


php artisan storage:link (Publier le dossier storage upload)

composer require rtconner/laravel-likeable "~3.0"


php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan clear-compiled
php artisan config:cache


php artisan migrate


php artisan route:list (Voir la liste des routes)


npm install (c'est le composer js pour instaler les dependances)

npm run dev (Quand on developpe le site pour le rendre rapide)

npm run watch (Pour surveiller les modification sur les fichiers JS)

npm run production (quand le site est en ligne on execute pour minifier le fichier css pour que le site tourne plus vite)

 php artisan make:model artiste -m
 
  php artisan migrate (pour l'inserer dans la base de donnée)
 
 php artisan make:migration create_produit_taille_table --create=produit_taille (Pour creer une table de liaison)
 
 
 
 php artisan make:migration add_field_type_id_table_tailles --table=tailles (Pour creer une clee etrangere)
 
$table->bigInteger('user_id')->unsigned()->nullable();
   $table->foreign('user_id')->references('id')->on('users');
 
 

 php artisan make:migration add_field_colums_lien_instagram_table_mouves --table=mouves  (Pour ajouter une colonne dans la table)
 
  php artisan make:migration add_banned_until_to_users_table (Pour ajouter une colonne dans la table)
  
  php artisan make:middleware CheckBanned (Pour bannir un utilisateur)

 
 composer require madcoda/php-youtube-api (API YouTube)
 
 php artisan vendor:publish
 

		
	Se connecter dans la base de donnée (pour afficher toutes les tables) 
	 php artisan tinker 
	 $p = Produit::all();
	 
	 

	 
	 creer une table de jointure
	 php artisan make:migration create_produit_recommende_table --create=produit_recommande
	 
	
	
	
	  composer require laravel/ui --dev
	  php artisan ui vue --auth (pour creer la partie authentication)
	  
	  +--+
	  
	  Ajouter ça dans User.php 
	  class User extends Authenticatable implements MustVerifyEmail
	 
    
	
	php artisan db:seed --class=RolesTableSeeder
	
	
	composer dump-autoload
	
	php artisan db:seed --Artisan_
	
	php artisan make:seeder TagTableSeeder (Creer la blable seeder)
	
	php artisan db:seed --class=Astiste_mediaTableSeeder

       php artisan make:factory MediaFactory --Model=Media (Pour creer des données factuelles dans la table media)

	
	php artisan make:middleware CheckAdmin (ce dossier est creer pour la secuirité)
		


php artisan make:migration create_produit_tag_table --create=produit_tag

php artisan make:seeder MediatagTableSeeder

php artisan db:seed --class=TagTableSeeder

SELECT * FROM artistes order by created_at DESC; (Pour mettre en ordre decroissant dans la base de donnée)

php artisan dump-autoload
 composer dump-autoload
 
 
 Toujour mettre @csrf apres les balise <form>
 
 enctype="multipart/form-data" (On rajoute dans le html pour l'integration des images dans le formulaire)
 
 php artisan storage:link (Pour deplacer le dissier upload dans public en ligne de commande)
 
 
 php artisan down (Pour activer le mode de maintenance)
 
 php artisan up (Pour désactiver le mode de maintenance)
 
  -->
