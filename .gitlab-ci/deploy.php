<?php

declare(strict_types=1);

namespace Deployer;

require 'recipe/common.php';
require 'recipe/rsync.php';
require 'recipe/cachetool.php';

// Global config
set('allow_anonymous_stats', false);

$rsync_config = [
    'exclude' => [
        '.git',
        'deploy.php',
    ],
    'exclude-file' => false,
    'include' => [],
    'include-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'rz',
    'options' => ['delete', 'links'],
    'timeout' => 60,
];

// Hosts
host('development')
    ->stage('development')
    ->hostname('mw@mw01-dev.tugraz.at')
    ->set('deploy_path', '/home/mw/dev01/deploy/api-server-template')
    ->set('shared_dirs', ['var/log', 'var/sessions'])
    ->set('APP_ENV', 'prod')
    ->set('APP_DEBUG', '0')
    ->set('KEYCLOAK_SERVER_URL', 'https://auth-dev.tugraz.at/auth')
    ->set('KEYCLOAK_REALM', 'tugraz-vpu')
    ->set('KEYCLOAK_FRONTEND_CLIENT_ID', 'dbp-api-template-frontend')
    ->set('rsync', $rsync_config)
    ->set('rsync_src', __DIR__.'/../')
    ->set('rsync_dest', '{{release_path}}')
    ->set('cachetool', '127.0.0.1:9001');

// Build task
task('build-custom', function () {
    $APP_ENV = get('APP_ENV');

    $vars = [
        'KEYCLOAK_CLIENT_SECRET' => getenv('KEYCLOAK_CLIENT_SECRET'),
        'APP_ENV' => $APP_ENV,
        'APP_DEBUG' => get('APP_DEBUG'),
        'KEYCLOAK_SERVER_URL' => get('KEYCLOAK_SERVER_URL'),
        'KEYCLOAK_REALM' => get('KEYCLOAK_REALM'),
        'KEYCLOAK_FRONTEND_CLIENT_ID' => get('KEYCLOAK_FRONTEND_CLIENT_ID'),
    ];

    // build .env.local file
    runLocally('rm -f .env.local');
    foreach ($vars as $key => $value) {
        if (!isset($value) || $value === '') {
            throw new \Exception("'${key}' is not set");
        }
        runLocally("echo '${key}=${value}' >> .env.local");
    }

    // Add build commit
    $commit = runLocally('git rev-parse --short HEAD');
    runLocally("echo \"API_BUILDINFO=${commit}\" >> .env.local");

    // Add commit url to gitlab
    $remote = runLocally('git config --get remote.origin.url');
    $parts = parse_url($remote);
    $parts['path'] = substr($parts['path'], 0, (strrpos($parts['path'], '.')));
    $base_url = $parts['scheme'].'://'.$parts['host'].$parts['path'];
    $build_url = $base_url.'/'.rawurlencode('commit').'/'.rawurlencode($commit);
    runLocally("echo \"API_BUILDINFO_URL=${build_url}\" >> .env.local");

    // composer install and optimize
    runLocally('composer install --no-dev --classmap-authoritative');

    // build .env.local.php file
    runLocally('rm -f .env.local.php');
    runLocally("composer dump-env '$APP_ENV'");
    runLocally('rm -f .env.local');

    // Cache warmup
    runLocally('php bin/console cache:clear');
    runLocally('php bin/console cache:warmup');
});

// Deploy task
task('deploy', [
    'deploy:info',
    'build-custom',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'rsync',
    'deploy:shared',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success',
]);
after('deploy:failed', 'deploy:unlock');

// Clear opcache
after('deploy:symlink', 'cachetool:clear:opcache');
