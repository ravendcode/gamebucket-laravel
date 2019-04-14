# Game Bucket

## Features

* Upload Unity Game
* Play In Game

## Requirements

* `PHP ^7.3`
* Set `post_max_size = 64M; upload_max_filesize = 64M;` in `php.ini`
* `Composer`
* `MySQL`

## Usage

* Rename `.env.example` in `.env` and edit
* `composer install`
* `php artisan migrate`
* `php artisan serve`
