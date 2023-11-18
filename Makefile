test:
	./vendor/bin/phpunit --testdox ./tests --filter "${filter}"

lint:
	./vendor/bin/phpcs --colors -p ./src

format:
	./vendor/bin/phpcbf ./src

.PHONY: test lint format
.SILENT: test lint format