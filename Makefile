ARTISAN  = php artisan
COMPOSER = composer
NPM      = npm
DOCKER   = docker-compose

.PHONY: install clean

## Install and start the project
install: .env vendor app-key docker assets

## Start docker container(s)
docker:
	$(DOCKER) up -d

## Remove generated files
clean:
	rm -rf .env vendor node_modules

## Generate an App Key
app-key: .env
	$(ARTISAN) key:generate

## Compile assets
assets: node_modules
	$(NPM) run dev

composer.lock: composer.json
	$(COMPOSER) update --lock --no-interaction

vendor: composer.lock
	$(COMPOSER) install --no-interaction --ansi --optimize-autoloader

node_modules: package-lock.json
	$(NPM) install
	@touch -c node_modules

package-lock.json: package.json
	$(NPM) upgrade

.env: .env.example
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.example file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.example .env;\
		cp .env.example .env;\
	fi
