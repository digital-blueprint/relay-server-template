#!/bin/sh
set -eu

exec tini -- sudo busybox crond -f -l 0 -L /dev/stdout