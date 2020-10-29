#!/bin/bash

set -e
TAG="registry.gitlab.tugraz.at/dbp/middleware/dbp-api/api-server-template:v1"
docker build --tag "${TAG}" --file "Dockerfile" .
docker run --rm --security-opt label=disable \
    --volume "$(pwd)/..:/home/user/app" --workdir "/home/user/app" \
    --tty --interactive "${TAG}" bash
echo "Now run: sudo docker push '$TAG'"