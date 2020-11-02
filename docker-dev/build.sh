#!/bin/bash

# We need to creat the user inside the container with the same ID as the host user
docker-compose build --build-arg "UID=${SUDO_UID:-$UID}"

# Install dependencies
docker-compose run --rm --entrypoint composer php-fpm install