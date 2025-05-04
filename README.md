# 🧪 Installation du projet Laravel

Ce projet est une application Laravel. Voici les étapes pour l’installer et la faire fonctionner localement.

---

## ✅ Prérequis

Assurez-vous d’avoir installé sur votre machine :

- PHP >= 8.1
- Composer
- Node.js et NPM
- Une base de données (MySQL ou PostgreSQL par exemple)
- Laravel CLI (facultatif mais pratique)

---

## ⚙️ Étapes d’installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/Amadoub-a/projet-pct-uvci
   cd projet-pct-uvci

composer install
cp .env.example .env

APP_NAME="E-Civil"
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=root
DB_PASSWORD=

php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
php artisan migrate:fresh --seed   # Réinitialiser la base de données
php artisan config:cache           # Recompiler les fichiers de config
npm run build                      # Compiler les fichiers front pour production

pour la connexion 
login : super-admin@e-civil.com
password : Ecivil@2025
