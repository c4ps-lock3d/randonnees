deploy: public/build/manifest.json
	rsync -avz public/build infomaniakrando:~/sites/rando.blizzardaudioclub.ch/public
	ssh infomaniakrando 'cd ~/sites/rando.blizzardaudioclub.ch && git pull origin master && make install'

install: vendor/autoload.php .env public/storage
	php artisan cache:clear
	php artisan migrate

.env:
	cp .env.example
	php artisan key:generate

public/storage:
	php artisan storage:link

vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php

public/build/manifest.json: package.json
	npm i
	npm run build