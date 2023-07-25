# Overview

Source: https://github.com/digital-blueprint/relay-server-template

The server template can be used as a template/starting point for your own API instance.
It consists of a minimally configured Symfony application and development environment
and includes/integrates:

* The [dbp/relay-core-bundle](https://packagist.org/packages/dbp/relay-core-bundle): Which provides the base functionality and ties everything together
* The [dbp/relay-auth-bundle](https://packagist.org/packages/dbp/relay-auth-bundle): Which provides authentication via OIDC
* A docker-compose based development environment
* Linter/Unittest integration

It also has the [DBP Symfony recipe repository](https://github.com/digital-blueprint/symfony-recipes) included,
so many DBP bundles get their configuration files and environment variables installed automatically.

## Installation

```bash
# Install the DBP API Server Template (https://github.com/digital-blueprint/relay-server-template)
# as base Symfony PHP application
# The relay-api/public directory then is the directory to let the webserver point at 
composer create-project dbp/relay-server-template relay-api

# Change to app directory
cd relay-api

# Install dependencies (you need php and composer for this)
composer install
```

See https://handbook.digital-blueprint.org/frameworks/relay/dev/getting_started for more information.
