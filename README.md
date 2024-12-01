# MedEco

MedEco is a mobile application designed to address two major healthcare challenges in Egypt: medication waste and the environmental impact of improper drug disposal. By redistributing unused, unexpired medications and providing a platform for their safe disposal, MedEco aims to prevent these medications from going to waste and reduce the harmful effects of improper disposal, such as incineration.

## Requirements

- **PHP**: ^8.2
- **Laravel Framework**: ^10.0

## Installation

1. Clone the repository:

    ```bash
    git clone <repository-url>
    cd <project-directory>
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Set up environment:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your .env file with your database and other necessary credentials.

5. Run migrations:

    ```bash
    php artisan migrate --seed
    ```

## Key Packages

- **[ahmed-aliraqi/laravel-media-uploader](https://github.com/ahmed-aliraqi/laravel-media-uploader)**: A package for managing media uploads.
- **[astrotomic/laravel-translatable](https://github.com/Astrotomic/laravel-translatable)**: Handles translations for Eloquent models.
- **[calebporzio/parental](https://github.com/calebporzio/parental)**: A parent-child relationship for Eloquent models.
- **[diglactic/laravel-breadcrumbs](https://github.com/diglactic/laravel-breadcrumbs)**: Generates breadcrumbs for your Laravel app.
- **[doctrine/dbal](https://www.doctrine-project.org/projects/dbal.html)**: Provides database abstraction layer for Laravel.
- **[guzzlehttp/guzzle](https://github.com/guzzle/guzzle)**: A PHP HTTP client for making requests.
- **[kreait/firebase-tokens](https://github.com/kreait/laravel-firebase)**: Firebase token management for Laravel.
- **[lab404/laravel-impersonate](https://github.com/LAB404/laravel-impersonate)**: Allows you to impersonate other users in your Laravel app.
- **[laracasts/flash](https://github.com/laracasts/flash)**: Flash messages for Laravel.
- **[laracasts/presenter](https://github.com/laracasts/Presenter)**: Presentation layer for Laravel models.
- **[laraeast/laravel-settings](https://github.com/laraeast/laravel-settings)**: Manages application settings.
- **[laravel/sanctum](https://laravel.com/docs/10.x/sanctum)**: Provides simple token-based authentication.
- **[laravel/tinker](https://laravel.com/docs/10.x/artisan#tinker)**: REPL for interacting with your Laravel application.
- **[laravel/ui](https://laravel.com/docs/10.x/frontend#installation)**: Provides UI scaffolding.
- **[pusher/pusher-php-server](https://github.com/pusher/pusher-php-server)**: PHP client library for Pusher.
- **[pusher/pusher-push-notifications](https://github.com/pusher/pusher-push-notifications-php)**: Push notifications for Pusher.
- **[spatie/laravel-backup](https://github.com/spatie/laravel-backup)**: Backup your Laravel application.
- **[spatie/laravel-permission](https://github.com/spatie/laravel-permission)**: Manage user roles and permissions.

## Development

For development, you will need the following additional tools:

- **[barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)**: Debugbar integration for Laravel.
- **[barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)**: Helps IDEs auto-complete.
- **[spatie/laravel-ignition](https://github.com/spatie/laravel-ignition)**: A beautiful exception page for Laravel.
- **[fzaninotto/faker](https://github.com/fzaninotto/Faker)**: Generate fake data for testing.
- **[friendsofphp/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)**: PHP code style fixer.
- **[laraeast/laravel-vue-i18n-generator](https://github.com/laraeast/laravel-vue-i18n-generator)**: Generate Vue i18n files from Laravel translations.
- **[laravel/sail](https://laravel.com/docs/10.x/sail)**: Provides a local development environment for Laravel.
- **[mockery/mockery](https://github.com/mockery/mockery)**: Mocking library for PHP.
- **[nunomaduro/collision](https://github.com/nunomaduro/collision)**: Error handling and debugging for Laravel.
- **[phpunit/phpunit](https://github.com/sebastianbergmann/phpunit)**: Testing framework for PHP.

## Scripts

- **`php-cs:issues`**: Check for code style issues.

- **`php-cs:fix`**: Fix code style issues.

- **`app:clear`**: Clear compiled files and cache.

- **`auto-complete:generate`**: Generate IDE helper files.

- **`post-update-cmd`**: Run after Composer update.

- **`post-autoload-dump`**: Run after autoload dump.

- **`post-root-package-install`**: Create .env file if it doesn't exist.

- **`post-create-project-cmd`**: Create .env file if it doesn't exist.

## Deploying Script

If you use valet just execute the **`init.sh`** file to configure your environment automatically.

```bash
cd my-app
bash ./init.sh
```

## Deploying Using Docker Container

```bash
cp .env.example .env

docker compose run --rm artisan key:generate
docker compose run --rm artisan storage:link --force
docker compose run --rm artisan migrate --seed

docker compose up
```
