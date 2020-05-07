lint:
	./vendor/bin/phpcs -- --standard=PSR2 src bin tests

test:
	./vendor/bin/phpunit tests

start:
	composer install
run:
	php bin/app.php