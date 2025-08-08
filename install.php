<?php
echo "Starting SBM-laravel installation...\n";

// Clone repository
if (!is_dir('SBM-laravel')) {
    exec('git clone https://github.com/Brwasb/SBM-laravel.git', $output, $return);
    if ($return !== 0) {
        die("Error cloning repository\n");
    }
}

chdir('SBM-laravel');

// Check for composer
if (!file_exists('composer.phar')) {
    echo "Downloading composer...\n";
    exec('php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"');
    exec('php composer-setup.php');
    exec('php -r "unlink(\'composer-setup.php\');"');
}

// Install dependencies
echo "Installing dependencies...\n";
exec('php composer.phar install --no-interaction --prefer-dist --no-dev', $output, $return);
if ($return !== 0) {
    die("Error installing dependencies\n");
}

// Setup .env
if (!file_exists('.env')) {
    copy('.env.example', '.env');
    exec('php artisan key:generate');
}

// Set permissions
echo "Setting up permissions...\n";
chmod('bootstrap/cache', 0775);
chmod('storage', 0775);

echo "Installation complete!\n";
echo "1. Configure your .env file\n";
echo "2. Run migrations with: php artisan migrate\n";
echo "3. Start the server with: php artisan serve\n";