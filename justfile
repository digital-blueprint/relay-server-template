# Use `just <recipe>` to run a recipe
# https://just.systems/man/en/

import ".shared/common.just"

# By default, run the `--list` command
default:
    @just --list

# Run linters on all files
[group('linter')]
lint:
    nix-shell -p php83Packages.composer --run "composer run lint"
