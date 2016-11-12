# Kudos Store - Ecommerce Platform for PHP & Laravel

[![Total Downloads](https://poser.pugx.org/kudosagency/kudos-php/downloads)](https://packagist.org/packages/kudosagency/kudos-php)
[![Latest Stable Version](https://poser.pugx.org/kudosagency/kudos-php/v/stable)](https://packagist.org/packages/kudosagency/kudos-php)
[![Latest Unstable Version](https://poser.pugx.org/kudosagency/kudos-php/v/unstable)](https://packagist.org/packages/kudosagency/kudos-php)
[![License](https://poser.pugx.org/kudosagency/kudos-php/license)](https://packagist.org/packages/kudosagency/kudos-php)

Kudos is a simple and fast Ecommerce platform built upon popular frameworks in PHP, Python, Ruby & Node.js.
This is the laravel/PHP package.

We wanted to create an ecommerce platform so simple that it has zero learning curve for the majority of developers. Kudos is fast, light and requires very few hosting resources.

## Official Documentation

Documentation for the framework can be found on the [Kudos Store website](http://kudos.store/php/docs/).

## Installation

git clone https://github.com/kudosagency/kudos-php.git .
cp .env.example .env
composer install
php artisan key:generate

sudo chown -R www-data:www-data /path/to/root
sudo find /path/to/root -type f -exec chmod 644 {} \; 
sudo find /path/to/root -type d -exec chmod 755 {} \;   

## License

Kudos Store is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
