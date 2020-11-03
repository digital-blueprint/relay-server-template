# DBP API Server Template

This repository can be used as a template/starting point for your own API instance.
It consists of a minimally configures Symfony application and development environment
and includes/integrates:

* The [dbp/api-core-bundle](https://gitlab.tugraz.at/dbp/middleware/dbp-api/api-core-bundle): Which provides authentication, some same base end points and entities and configuration for [api-platform](https://api-platform.com/)
* The [dbp/api-starter-bundle](https://gitlab.tugraz.at/dbp/middleware/dbp-api/api-starter-bundle): Which acts as a template for creating new bundles as
  we as an example for what can be done in a bundle.
* A docker-compose based development environment
* Linter/Unittest integration

## Documentation

The documentation is work in progress and currently exists in another repository which can be viewed here:
https://api.tugraz.at/docs/index.html

It will be moved into this repository in the near future.

## Creating your own API instance and creating your own Bundle

* Fork this repository
* Run the docker-compose based development environment and test it
* Copy the "api-starter-bundle" repo and rename everything
* Add the new bundle to your API fork

## Development

Please open [docker-dev/README.md](./docker-dev/README.md) for more information.
