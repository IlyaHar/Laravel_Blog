# Blog Laravel
## Installation
1. Clone project from GitHub
> git clone git@github.com:IlyaHar/Laravel_Blog.git
2. Install Composer and Npm
> composer install

> npm install

## Settings

3. Copy all from .env.example, create .env and paste it there. Then configure database, mail and Google api for oAuth2
    *For mail you can use MailTrap or other such services*

## Getting Started
> php artisan key:generate

> php artisan migrate --seed

*After starting seeding you need to wait a little (3-5 minutes)*

> npm run dev

> php artisan queue:work

> php artisan serve

# Have a great time!
