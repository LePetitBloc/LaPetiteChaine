.DEFAULT_GOAL := help
.PHONY: help
help:
	@grep -E '^[a-zA-Z-]+:.*?## .*$$' Makefile | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "[32m%-15s[0m %s\n", $$1, $$2}'

build: ## Build the project
	docker-compose up --build -d
	docker-compose exec app mkdir -p var/cache var/log var/sessions vendor
	docker-compose exec app composer install --prefer-dist --no-progress --no-suggest
	docker-compose exec app composer clear-cache
	docker-compose exec app chown -R www-data var
	docker-compose stop

start: ## Start application
	docker-compose start
	docker-compose exec app composer install --prefer-dist --no-progress --no-suggest
	docker-compose exec app composer clear-cache
	docker-compose exec app chown -R www-data var

stop: ## Stop application
	docker-compose stop

down: ## Remove the project
	docker-compose down --rmi local

test: ## Execute tests
	docker-compose exec app vendor/bin/phpspec run

###> symfony/framework-bundle ###
CONSOLE := $(shell which bin/console)
sf_console:
ifndef CONSOLE
	@printf "Run \033[32mcomposer require cli\033[39m to install the Symfony console.\n"
endif

cache-clear: ## Clears the cache
ifdef CONSOLE
	@bin/console cache:clear --no-warmup
else
	@rm -rf var/cache/*
endif
.PHONY: cache-clear

cache-warmup: cache-clear ## Warms up an empty cache
ifdef CONSOLE
	@bin/console cache:warmup
else
	@printf "Cannot warm up the cache (needs symfony/console).\n"
endif
.PHONY: cache-warmup

serve_as_sf: sf_console
ifndef CONSOLE
	@${MAKE} serve_as_php
endif
	@bin/console list | grep server:start > /dev/null || ${MAKE} serve_as_php
	@bin/console server:start

	@printf "Quit the server with \033[32;49mbin/console server:stop\033[39m\n"

serve_as_php:
	@printf "\033[32;49mServer listening on http://127.0.0.1:8000\033[39m\n"
	@printf "Quit the server with CTRL-C.\n"
	@printf "Run \033[32mcomposer require symfony/web-server-bundle\033[39m for a better web server.\n"
	php -S 127.0.0.1:8000 -t public

serve: ## Runs a local web server
	@${MAKE} serve_as_sf
.PHONY: sf_console serve serve_as_sf serve_as_php
###< symfony/framework-bundle ###
