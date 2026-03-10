# 🚀 Système de Réservation Restaurant - Laravel FullStack

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-00000f?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://javascript.com)

## 📋 Présentation
Ce projet est une solution de gestion de réservations "End-to-End" pour restaurant. Il combine une interface client fluide et un **Back-Office d'administration robuste** permettant de gérer les flux de clients, l'attribution des tables et le suivi des statuts en temps réel.



---

## ✨ Fonctionnalités Clés

### 🔐 Espace Administration (Back-Office)
- **Dashboard Dynamique** : Vue d'ensemble des réservations avec filtres (Statut, Source, Date).
- **Gestion Multi-Tables** : Attribution intelligente de plusieurs tables pour une seule réservation (Ex: Réunion de famille sur tables T.1, T.4, T.5).
- **Réservation Téléphonique** : Module de saisie rapide pour les appels clients avec sélection visuelle des tables disponibles.
- **Suivi des Statuts** : Confirmation, Annulation et Archivage via des requêtes asynchrones (Fetch API).
- **Rendu Blade Optimisé** : Affichage des tables sous forme de badges individuels pour une lisibilité maximale.

### 🌐 Espace Client
- Formulaire de réservation en ligne avec validation des données.
- Choix de l'emplacement (Terrasse / Intérieur).

---

## 🛠️ Stack Technique
- **Backend** : Laravel 10/11 (PHP 8.2+)
- **Base de données** : MySQL (Modélisation Relationnelle)
- **Frontend** : Blade Engine, Tailwind CSS, JavaScript Vanilla (AJAX / Fetch API)
- **DevOps** : Docker Desktop & Laravel Sail

---

## 🐳 Installation & Lancement

### 1. Prérequis : Docker Desktop
Si vous n'avez pas Docker, téléchargez-le selon votre système :
* **Windows / macOS** : [Télécharger Docker Desktop](https://www.docker.com/products/docker-desktop/) (Activez WSL2 sur Windows).
* **Linux** : [Installer Docker Engine](https://docs.docker.com/engine/install/).



### 2. Démarrage Rapide (Laravel Sail)

1.  **Cloner le dépôt** :
    ```bash
    git clone [https://github.com/TON_PSEUDO/NOM_DU_PROJET.git](https://github.com/TON_PSEUDO/NOM_DU_PROJET.git)
    cd NOM_DU_PROJET
    ```

2.  **Configurer l'environnement** :
    ```bash
    cp .env.example .env
    ```

3.  **Lancer les conteneurs Docker** :
    ```bash
    ./vendor/bin/sail up -d
    ```
    *(Cette étape télécharge les images PHP, MySQL et Redis nécessaires au projet).*

4.  **Initialiser l'application** :
    ```bash
    ./vendor/bin/sail composer install
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate
    ```

5.  **Accès** :
    Ouvrez votre navigateur sur [http://localhost](http://localhost).

---

## 💻 Installation Classique (Sans Docker)

Si vous possédez déjà un serveur local (Apache/MySQL) :
1. `composer install`
2. Configurez votre fichier `.env` avec vos accès DB locaux.
3. `php artisan migrate`
4. `php artisan serve`

---

## 🧠 Défis Techniques Relevés
- **Gestion de données complexes** : Implémentation d'une logique de "split" en Blade pour transformer des chaînes SQL (tables_id) en éléments UI distincts et stylisés.
- **Architecture API** : Séparation de la logique de validation et de la persistance des données dans le contrôleur pour garantir l'intégrité de la base de données.
- **UX Réactive** : Gestion des erreurs HTTP (500, 404) côté client pour une expérience utilisateur sans friction.

---

## 📸 Captures d'écran
*(Ajoutez ici vos images dans un dossier /screenshots de votre repo)*
`![Dashboard Admin](./screenshots/dashboard.png)`

---

🔧 **Développé par Samuel** - Projet Portfolio.
