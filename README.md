<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Plateforme de gestion de séminaires

Ce projet est une application web de gestion de séminaires académiques développée avec Laravel (backend) et Blade + Bootstrap (frontend).

## Objectif

Faciliter la soumission, la validation, la programmation et la consultation des séminaires universitaires.

## Fonctionnalités principales

### 1. Rôles des utilisateurs

####  Admin (Secrétaire)

* Crée des comptes d'enseignants
* Consulte toutes les demandes de séminaire
* Valide ou rejette un séminaire en modifiant son statut
* Attribue une date à un séminaire validé
* Envoie automatiquement un email à tous les utilisateurs pour les informer d'un nouveau séminaire programmé

####  Enseignants

* Font une demande de séminaire (titre, thème, description)
* Désignent des co-présentateurs parmi les enseignants via un champ multiple
* Peuvent consulter les séminaires qu'ils ont présentés sur leur profil

####  Tous les utilisateurs (y compris étudiants)

* Peuvent consulter la liste des séminaires programmés (vue blog)



## Fonctionnement technique

### Backend (Laravel)

* Modèles principaux : `User`, `Seminaire`, `Copresentateur`
* Notifications : `SeminaireProgrammer`
* Middleware : `auth`, `admin` , `enseignant`
* Contrôleurs :

  * `UserController` (gestion des enseignants)
  * `SeminaireController` (création, validation, affichage)
* Table pivot : `copresentateur_seminaire` (relation Many-to-Many entre enseignants et séminaires)

### Frontend (Blade + Bootstrap)

* Templates : `dashboard.blade.php`, `create.blade.php`, `show.blade.php`, `index.blade.php`, `profile.blade.php`
* Formulaires :

  * Création d'utilisateur (admin)
  * Création de séminaire (enseignant)
  * Validation + attribution de date (admin)
  * Choix des co-présentateurs via `<select multiple>`

##  Flux de travail

1. L'admin crée un enseignant.
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 25 01" src="https://github.com/user-attachments/assets/0581f33d-b7b0-4062-9b24-6319adf730c2" />
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 25 14" src="https://github.com/user-attachments/assets/beba9cd5-ab04-4be1-895a-df75e99e4a96" />
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 27 37" src="https://github.com/user-attachments/assets/1e2c5b70-73cb-4e50-b995-160bcbf494a3" />

2. L'enseignant se connecte et propose un séminaire (titre, description, thème, co-présentateurs).
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 29 52" src="https://github.com/user-attachments/assets/5ef18ac2-1e49-48c2-ac58-b5c0f7900ac9" />
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 32 28" src="https://github.com/user-attachments/assets/d282cf51-c0fc-4bf3-9f81-5c275eea5275" />
 <img width="1440" alt="Capture d’écran 2025-06-06 à 23 32 28" src="https://github.com/user-attachments/assets/017d79fa-700f-40c3-b9ed-f94c84af2081" />

3. L'admin voit toutes les demandes, modifie le statut et attribue une date.
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 34 06" src="https://github.com/user-attachments/assets/d1f01b95-de97-461d-a5f4-7e55b29c1aa5" />
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 34 24" src="https://github.com/user-attachments/assets/b5a31d14-ba36-47ad-8aad-0e46572c5bfc" />

4. Une notification par mail est envoyée à tous les utilisateurs.
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 34 57" src="https://github.com/user-attachments/assets/3122dd22-723c-4c89-b86a-7194ad1ed81c" />

<img width="1440" alt="Capture d’écran 2025-06-06 à 23 35 44" src="https://github.com/user-attachments/assets/689c9563-c017-4e84-abfe-c821c1f7a0d6" />

5. Tous peuvent consulter les séminaires validés dans une vue "blog".
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 36 11" src="https://github.com/user-attachments/assets/41a51a27-5d39-4eed-bce0-f7509ebf122d" />
<img width="1440" alt="Capture d’écran 2025-06-06 à 23 36 21" src="https://github.com/user-attachments/assets/0aa1123f-4421-4e63-a7d8-5cc122e32a91" />

## Diagramme de classe simplifie
<img width="900" alt="Capture d’écran 2025-06-07 à 00 50 04" src="https://github.com/user-attachments/assets/1ed02a4e-360e-4285-886e-765f694b69f0" />

## 🛠️ Technologies utilisées

- Laravel
- Bootstrap (pour le design responsive)
- MySQL (base de données)
- Notifications par mail (Mailtrap ou Mailhog)
- Blade (moteur de templates Laravel)

## 📦 Installation locale du projet

### 1. Cloner le projet

```bash
git clone https://github.com/votre-utilisateur/nom-du-projet.git
cd nom-du-projet
```
### 2. Installer les dépendances PHP

```bash
composer install
```
### 3. Copier le fichier .env

```bash
cp .env.example .env
```
### 4. Générer la clé d'application

```bash
php artisan key:generate
```
### 5. Créer et configurer votre base de données
Créez une base de données MySQL localement (par exemple seminaires_db) puis configurez le fichier .env :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seminaires_db
DB_USERNAME=root
DB_PASSWORD=motdepasse
```
### 6. Importer la base de données
Le fichier dump.sql contient la structure et les données initiales de la base de données.
Exécute cette commande ou importe le fichier avec phpMyAdmin :
```bash
mysql -u root -p seminaires_db < dump.sql
```
### 7. Lancer le serveur

```bash
php artisan serve
```
L'application sera accessible sur :
http://127.0.0.1:8000

## ✉️ Configuration des emails (Mailtrap)

Ajoute ceci dans ton fichier .env pour utiliser Mailtrap :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=ton_identifiant_mailtrap
MAIL_PASSWORD=ton_motdepasse_mailtrap
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=admin@seminaire.local
MAIL_FROM_NAME="Plateforme Séminaires"
```

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
