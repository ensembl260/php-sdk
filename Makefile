DOCKER =

composer/install: ## Launch composer install
	@$(DOCKER) php -d memory_limit=-1 ./bin/composer.phar install --no-interaction --no-scripts

composer/update: ## Launch composer update
	@$(DOCKER) php -d memory_limit=-1 ./bin/composer.phar update --no-interaction --no-scripts

cs/dry-run: ## Run PHPCS with dry-run option
	@$(DOCKER) ./bin/php-cs-fixer-v3.phar fix src --dry-run --verbose --diff
	@$(DOCKER) ./bin/php-cs-fixer-v3.phar fix tests --dry-run --verbose --diff

cs/fix: ## Run PHPCS with automatic fix
	@$(DOCKER) ./bin/php-cs-fixer-v3.phar fix src --verbose --diff
	@$(DOCKER) ./bin/php-cs-fixer-v3.phar fix tests --verbose --diff

phpunit/filter: ### Run phpunit with --filter PHPUNIT_TEST
	@$(DOCKER) php -d memory_limit=-1 ./vendor/bin/phpunit --filter $(PHPUNIT_TEST)

phpunit/all: ### Run phpunit with options as PHPUNIT_OPTIONS
	@$(DOCKER) php -d memory_limit=-1 ./vendor/bin/phpunit $(PHPUNIT_OPTIONS)

.PHONY: help cs phpunit

HELP_FUNCTION = \
	%help; \
    while(<>) { push @{$$help{$$2 // 'options'}}, [$$1, $$3] if /^([a-zA-Z\-\/]+)\s*:.*\#\#(?:@([a-zA-Z\-]+))?\s(.*)$$/ }; \
    print "usage: make [target]\n\n"; \
    for (sort keys %help) { \
    for (@{$$help{$$_}}) { \
    $$sep = " " x (32 - length $$_->[0]); \
    print "  \033[0;33m$$_->[0]\033[0;37m$$sep\033[0;32m$$_->[1]\033[0;37m\n"; \
    }; \
    print "\n"; }

.DEFAULT_GOAL := help

help: ##@other Show this help.
	@$(DOCKER) perl -e '$(HELP_FUNCTION)' $(MAKEFILE_LIST)

ERR = $(error found an error!)

err: ; $(ERR)
