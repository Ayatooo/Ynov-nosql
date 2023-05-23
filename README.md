# Installation ⬇️
To run the project, you'll need :

    php 8+
    docker fully installed (client on windows or wsl)
    composer 2.0+
    node v17+
    Clone the projet and navigate inside with your terminal to execute the next commands

Then,

    docker run --rm --interactive --tty \
    --volume $PWD:/app \
    composer install --ignore-platform-reqs
And,

    docker run --rm --interactive --tty \
    --volume $PWD:/app \
    composer require laravel/sail --dev

Then,

    copy and paste the .env.example in the .env, you don't have to  change it
    run : npm install
    run : php artisan sail:install : and select redis (3)
    run : ./vendor/bin/sail up
    after the installation, you can rerun if it's down
