# Running with Docker

This is simple docker-compose setup using docker with php-fpm and nginx to serve
the symfony app.

## Setup

* `sudo apt install docker-compose` to install docker-compose on Debian/Ubuntu
* `sudo ./build.sh` - to build the docker images and install the PHP dependencies
* `sudo docker-compose up` - to run the server: http://127.0.0.1:8000

## Running the Server

* `sudo docker-compose up -d` to start the server in the background
* `sudo docker-compose up` to start the server in the foreground with logs
* `sudo docker-compose stop` to stop the server
* `sudo docker-compose logs -f` to see the logs
* `sudo docker-compose restart messenger-worker` restart messenger worker for updating message handling code

## Executing Symfony commands

* `./run.sh` to start a shell in the php-fpm container.
* After this you can run symfony/composer commands like:
  * `./bin/console debug:config`
  * `composer install`
  * `composer test`
* You can also call `bin/console` commands directly from outside the container with `./console debug:config`
  if you have all dependencies available on the host.

## Links

* Open <http://127.0.0.1:8000/> for the API Platform webpage
* Open <http://localhost:8101/> for redis commander
