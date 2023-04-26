# DBP Relay API Server Template

[GitHub](https://github.com/digital-blueprint/relay-server-template) |
[Packagist](https://packagist.org/packages/dbp/relay-server-template)

[![Test](https://github.com/digital-blueprint/relay-server-template/actions/workflows/test.yml/badge.svg)](https://github.com/digital-blueprint/relay-server-template/actions/workflows/test.yml)

This repository can be used as a template/starting point for your own API instance.
It consists of a minimally configures Symfony application and development environment
and includes/integrates:

* The [dbp/relay-core-bundle](https://packagist.org/packages/dbp/relay-core-bundle): Which provides the base functionality and ties everything together
* The [dbp/relay-auth-bundle](https://packagist.org/packages/dbp/relay-auth-bundle): Which provides authentication via OIDC
* A docker-compose based development environment
* Linter/Unittest integration

## Creating your own API Instance using this Template

```
composer create-project dbp/relay-server-template my-api "dev-main"
```

See https://handbook.digital-blueprint.org/relay/dev/getting_started for more information.

## Development

Please see [docker-dev/README.md](./docker-dev/README.md) for more information.
