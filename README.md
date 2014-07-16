Laravel Markdown
================


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-Markdown/master.svg?style=flat)](https://travis-ci.org/GrahamCampbell/Laravel-Markdown)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Markdown.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Markdown.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat)](LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-Markdown.svg?style=flat)](https://github.com/GrahamCampbell/Laravel-Markdown/releases)


## Introduction

Laravel Markdown was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [Parsedown Extra](https://github.com/erusev/parsedown-extra) wrapper for [Laravel 4.1+](http://laravel.com). It ships with **integration with Laravel's view system** too. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Markdown/releases), [license](LICENSE.md), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).


## Installation

[PHP](https://php.net) 5.4.7+ or [HHVM](http://hhvm.com) 3.1+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Markdown, simply require `"graham-campbell/markdown": "~2.0"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Markdown is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Markdown\MarkdownServiceProvider'`

You can register the Markdown facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'Markdown' => 'GrahamCampbell\Markdown\Facades\Markdown'`


## Configuration

Laravel Markdown supports optional configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/markdown

There is one config options:

##### Enable The Engines

This option (`'engines'`) specifies if the view engines are enabled so you can write markdown views and have them compiled into html. The following extensions are currently supported: `'.md'`, `'.md.php'`, and `'.md.blade.php'`. You may disable the engines if they are conflicting with another package. The default value for this setting is `true`.


## Usage

##### Markdown

This is the class of most interest. It is bound to the ioc container as `'markdown'` and can be accessed using the `Facades\Markdown` facade. There is one public method of interest.

The `'render'` method will parse a string as markdown using Emanuil Rusev's [Parsedown Extra](https://github.com/erusev/parsedown-extra) package, and will return a string of html.

##### Facades\Markdown

This facade will dynamically pass static method calls to the `'markdown'` object in the ioc container which by default is the `Markdown` class.

##### MarkdownServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `app/config/app.php`. This class will setup ioc bindings.

##### Further Information

There are other classes in this package that are not documented here (such as the engine classes). This is because they are not intended for public use and are used internally by this package.

Feel free to check out the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel Markdown.

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## License

Apache License

Copyright 2013-2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
