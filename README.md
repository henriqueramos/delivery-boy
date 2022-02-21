# Delivery Boy

## Table of Contents
  * [About](#about)
  * [How to run?](#how-to-run-)
    + [Cloning it](#cloning-it)
  * [Installing it](#installing-it)
    + [Without developer dependencies](#without-developer-dependencies)
    + [With developer dependencies](#with-developer-dependencies)
  * [Configuring dotenv](#configuring-dotenv)
  * [Examples](#examples)
  * [Nerd Stuff](#nerd-stuff)
  * [Contact me](#contact-me)

## About

Hello!

You've found the Delivery Boy repository!

This repository was made for fun, to test some "new" features of PHP 8.x.

You will find here some advanced techniques like [Chain of Responsibility](https://refactoring.guru/design-patterns/chain-of-responsibility), [Adapters](https://refactoring.guru/design-patterns/adapter), an example of [Liskov Substitution Principle](https://en.wikipedia.org/wiki/Liskov_substitution_principle) and other beautiful things of [SOLID principles](https://www.freecodecamp.org/news/solid-principles-explained-in-plain-english/).

## How to run?

This code only runs on environments with PHP >= 8.0! Why? Because PHP 7.4 is reaching his [EOL](https://en.wikipedia.org/wiki/End-of-life_product). So, migrate over 8.x family and be happy. You could learn more about the supported versions [here](https://www.php.net/supported-versions.php).

You will need [composer](https://getcomposer.org/) too, because he's doing all the namespace magic under the hood for us.

Oh, you didn't know about composer? Take a look on this [blogspot](https://blog.jgrossi.com/2013/why-you-should-use-composer-and-how-to-start-using-it/)!

### Cloning it

You will need to clone the repository, so, go ahead! Have some fun using `git` command line interface (a.k.a `CLI`).

## Installing it

Once you got a composer's copy, run this command on your local repository clone.

### Without developer dependencies

``
composer install --no-dev
``

If you choose to install without developer dependencies, Composer will check if you're using an environment with PHP >= 8.0 (otherwise, he will shutdown the installation process), and create the `vendor/autoload.php` file.

### With developer dependencies

Ok! Do you want some fun! So, run the following command to install the developer dependencies:

``
composer install
``

This will install the following dependencies to help you on dev tasks:

* `phpunit/phpunit`, to run unit tests easily;
* `dms/phpunit-arraysubset-asserts`, to use the deprecated `assertArraySubset` again;
* `squizlabs/php_codesniffer`, to detect [code smells](https://refactoring.guru/pt-br/refactoring/smells);
* `slevomat/coding-standard`, to force you to follow beautiful rules, like [PSR-12](https://www.php-fig.org/psr/psr-12/);

## Configuring dotenv

Did you think I committed some kind of secret key here? Nah! It's against [one](https://12factor.net/config) of the Twelve-Factor App pillars.

``
Store config in the environment
``

In order to run the Delivery Boy properly, you should copy the `.env.example` file, rename the copy as `.env`, and fill the variables:

>API_URL=
>
>API_KEY=


Do you know the values, of course. ;)

## Examples

Oorah! You've reached the end of the configuration's chapters. You ROCK!

I've prepared two examples for you. Showing how to use the Delivery Boy!

They're located on `examples` folder.

* `create_new_package.php`;
* `request_package_label.php`;

You could run those from `CLI` using `php -f examples/<FILENAME>`.

The `request_package_label.php` needs to be updated with the result of `create_new_package`. Check the line 9, and replace the value of `$trackingNumber` variable.

## Nerd Stuff

During the coding process I used the [baby steps concept](https://codingdojo.org/BabySteps/) and cover the changes using unit tests. Also, I've used [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) (or at least, tried :P).

[Code coverage](https://en.wikipedia.org/wiki/Code_coverage) its over 80%.

You can check this running the following command on your repository's root:

>export XDEBUG_MODE=coverage && ./vendor/bin/phpunit --debug --coverage-html "coverage/html"

Disclaimer: You gonna need XDebug to run this. ;)

## Contact me

Anything else? Just drop a message on my [LinkedIn](https://www.linkedin.com/in/henriqueramos/?locale=en_US).

Cya!