# DBP Relay API Server Template

[GitLab](https://gitlab.tugraz.at/dbp/relay/dbp-relay-server-template)

This repository can be used as a template/starting point for your own API instance.
It consists of a minimally configures Symfony application and development environment
and includes/integrates:

* The [dbp/relay-core-bundle](https://gitlab.tugraz.at/dbp/relay/dbp-relay-core-bundle): Which provides the base functionality and ties everything together
* The [dbp/relay-auth-bundle](https://gitlab.tugraz.at/dbp/relay/dbp-relay-auth-bundle): Which provides authentication via OIDC
* A docker-compose based development environment
* Linter/Unittest integration

## Creating your own API Instance using this Template

See https://dbp-demo.tugraz.at/dev-guide/relay/getting_started/

## Development

```bash
# clone git repository
git clone https://gitlab.tugraz.at/dbp/relay/dbp-relay-server-template.git relay-api
cd relay-api

# install dependencies (you need php and composer for this)
# you can also do this in the dev docker container (see below docker-dev link)
composer install
```

Please open [docker-dev/README.md](./docker-dev/README.md) for more information.
