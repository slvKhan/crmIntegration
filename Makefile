lint:
	./vendor/bin/phpcs -- --standard=PSR2 src bin tests

test:
	composer test