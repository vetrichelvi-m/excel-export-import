xampp servePrerequisites
PHP 8.1 or above
XAMPP Version: 8.1.17
mysql port :3307
Node 16.18.x or above

Installation

Clone the repository


Install dependancies

composer install

Copy .env.example to .env

cp .env.example .env

Generate application key

php artisan key:generate


Edit .env file to add database credentials



npm install
npm run build

Visit http://localhost:8000/
