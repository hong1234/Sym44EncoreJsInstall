# Sym44EncoreJsInstall

git clone https://github.com/hong1234/Sym44EncoreJsInstall.git

cd Sym44EncoreJsInstall

composer install

touch .env.local

// .env.local

APP_ENV=prod

DATABASE_URL=mysql://root:vuanh123@127.0.0.1:3306/htest1

// .env.local ende

php bin/console make:migration

php bin/console doctrine:migrations:migrate

npm install

yarn encore production

php -S localhost:8000 -t public/

http://localhost:8000
