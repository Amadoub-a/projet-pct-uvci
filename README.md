# 🧪 Installation du projet Laravel — E-Civil

Ce projet est une application Laravel nommée **E-Civil**, développée pour la gestion des documents administratifs.

Assurez-vous d’avoir installé sur votre machine : PHP >= 8.1, Composer, Node.js & NPM, MySQL ou PostgreSQL, Laravel CLI (facultatif mais recommandé).

---

## ⚙️ Installation rapide

```bash
# 1. Cloner le projet
git clone https://github.com/Amadoub-a/projet-pct-uvci
cd projet-pct-uvci

# 2. Installer les dépendances backend
composer install

# 3. Copier le fichier d’environnement
cp .env.example .env

# 4. Modifier les variables d’environnement (.env)
# Exemple :
APP_NAME="E-Civil"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=root
DB_PASSWORD=

# 5. Générer la clé d'application
php artisan key:generate

# 6. Exécuter les migrations et seeders
php artisan migrate --seed

# 7. Installer les dépendances front-end
npm install && npm run dev

# 8. Lancer le serveur de développement
php artisan serve

php artisan migrate:fresh --seed   # Réinitialiser toute la base de données avec les seeders
php artisan config:cache           # Recompiler les fichiers de configuration
npm run build                      # Compiler les assets front pour la production

Accès à l'application
Email : super-admin@e-civil.com
Mot de passe : Ecivil@2025

