<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Kenya AFA TD');

// Project repository
set('repository', 'git@bitbucket.org:idealideas/pprs-site.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

set('allow_anonymous_stats', false);

host('5.188.55.38')
    ->port(22)
    ->user('root')
    ->identityFile('~/.ssh/tea.key')
    ->set('deploy_path', '/var/www');

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

desc('Execute queue:restart');
task('supervisor:queue:restart', function () {
    run('supervisorctl restart all');
});

desc('Clear opcache');
task('opcache:clear', function () {
    run('{{bin/php}} {{release_path}}/artisan opcache:clear');
});

desc('Execute php:reload');
task('php:reload', function () {
    run('systemctl reload php72-php-fpm.service');
});

task('deploy:owner', function () {
    run('chown -R nginx:nginx /var/www');
});

task('artisan:backup:run', function () {
    run('{{bin/php}} {{release_path}}/artisan backup:run --only-db');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

//before('artisan:migrate', 'artisan:backup:run');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
//after('artisan:config:cache', 'artisan:route:cache');

after('deploy:writable', 'php:reload');
//after('deploy:writable', 'opcache:clear');

after('deploy:symlink', 'supervisor:queue:restart');
//after('deploy:symlink', 'opcache:clear');

after('deploy:symlink', 'deploy:owner');
after('deploy:symlink', 'php:reload');