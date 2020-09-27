# Sym44EncoreJsInstall

git clone https://github.com/hong1234/Sym44EncoreJsInstall.git

cd Sym44EncoreJsInstall

composer install

npm install


php bin/console make:migration

php bin/console doctrine:migrations:migrate

yarn encore production

php -S localhost:8000 -t public/

http://localhost:8000/search/location
