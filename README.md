Laravel Markdown
================

Laravel Markdown was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [CommonMark](https://github.com/thephpleague/commonmark) wrapper for [Laravel 5](http://laravel.com). It ships with **integration with Laravel's view system** too. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Markdown/releases), [license](LICENSE), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Markdown](https://cloud.githubusercontent.com/assets/2829600/4432292/c10da636-468c-11e4-9ed9-dac778a15cd5.PNG)

<p align="center">
<a href="https://travis-ci.org/GrahamCampbell/Laravel-Markdown"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-Markdown/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Markdown.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Markdown.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Markdown/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Markdown.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Markdown, simply add the following line to the require block of your `composer.json` file:

```
"graham-campbell/markdown": "~3.0"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Markdown is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Markdown\MarkdownServiceProvider'`

You can register the Markdown facade in the `aliases` key of your `config/app.php` file if you like.

* `'Markdown' => 'GrahamCampbell\Markdown\Facades\Markdown'`

#### Looking for a laravel 4 compatable version?

Checkout the [2.0 branch](https://github.com/GrahamCampbell/Laravel-Markdown/tree/2.0), installable by requiring `"graham-campbell/markdown": "~2.0"`.


## Configuration

Laravel Markdown supports optional configuration.

To get started, first publish the package config file:

```bash
$ php artisan publish:config graham-campbell/markdown
```

There is one config options:

##### Enable View Integration

This option (`'views'`) specifies if the view integration is enabled so you can write markdown views and have them rendered as html. The following extensions are currently supported: `'.md'`, `'.md.php'`, and `'.md.blade.php'`. You may disable this integration if it is conflicting with another package. The default value for this setting is `true`.


## Usage

##### Facades\Markdown

This facade will dynamically pass static method calls to the `'markdown'` object in the ioc container which by default is an instance of `League\CommonMark\CommonMarkConverter`.

##### MarkdownServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Further Information

There are other classes in this package that are not documented here (such as the engine and compiler classes). This is because they are not intended for public use and are used internally by this package.

Feel free to check out the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel Markdown.


## License

Laravel Markdown is licensed under [The MIT License (MIT)](LICENSE).
