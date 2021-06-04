export SHELL := /bin/bash
export LOCATION := $(shell pwd)
export HOST_UID := $(shell id -u)
export HOST_GID := $(shell id -g)
export WORKDIR := /home/user
export DOCKER_COMPOSE := docker-compose -p paymefy -f ${LOCATION}/docker-compose.yml 

default: install ;

# First time install build an run
install : pull up composer database migrate

# Pull
pull : 
	docker pull furbyus/php8-cli:latest
	docker pull mariadb:10.6.1-focal

# Run the environment
up :
	@${DOCKER_COMPOSE} up -d --remove-orphans

# Upgrade and run the environment
upgrade :
	@${DOCKER_COMPOSE} pull
	@${DOCKER_COMPOSE} up -d --remove-orphans

# Destroy environment but without removing persistent data
down :
	@${DOCKER_COMPOSE} down

# Clean (Stop containers, remove images...)
clean :
	@${DOCKER_COMPOSE} stop
	@${DOCKER_COMPOSE} down --rmi all --remove-orphans

# Reinstall, stopping containers and removing images
reinstall: | clean install

# Enter a shell inside php container
shell :
	@${DOCKER_COMPOSE} exec -u user -w "/home/user/app" php ${SHELL}

# Restart the environment
restart :
	@${DOCKER_COMPOSE} restart

# Recreate environment (cleaning files)
recreate :
	@${DOCKER_COMPOSE} up -d --force-recreate

# Composer install
composer :
	@${DOCKER_COMPOSE} exec -T -u user -w "/home/user/app" php composer install

# Composer update
composer-update : 
	@${DOCKER_COMPOSE} exec -T -u user -w "/home/user/app" php composer update

# Database creation
database : 
	@${DOCKER_COMPOSE} exec -T -u user -w "/home/user/app" php php bin/console doctrine:database:create

# Database migrate
migrate :
	@${DOCKER_COMPOSE} exec -T -u user -w "/home/user/app" php php bin/console doctrine:migrations:migrate