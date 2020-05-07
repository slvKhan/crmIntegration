lint:
	./vendor/bin/phpcs -- --standard=PSR2 src bin

test:
	./vendor/bin/phpunit tests

start:
	composer install
run:
	php bin/app.php