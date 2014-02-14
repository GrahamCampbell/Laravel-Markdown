Laravel Markdown
================


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/Laravel-Markdown/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/Laravel-Markdown.png)](https://travis-ci.org/GrahamCampbell/Laravel-Markdown)
[![Coverage Status](https://coveralls.io/repos/GrahamCampbell/Laravel-Markdown/badge.png)](https://coveralls.io/r/GrahamCampbell/Laravel-Markdown)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown/badges/quality-score.png?s=91550d4afdf2961a89d17eb76b3c26304749d872)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/15243b7d-e94d-45b6-a761-2a9dfb153b1f/mini.png)](https://insight.sensiolabs.com/projects/15243b7d-e94d-45b6-a761-2a9dfb153b1f)
[![Software License](https://poser.pugx.org/graham-campbell/markdown/license.png)](https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md)
[![Latest Version](https://poser.pugx.org/graham-campbell/markdown/v/stable.png)](https://packagist.org/packages/graham-campbell/markdown)


## What Is Laravel Markdown?

Laravel Markdown is a simple [PHP Markdown Next](https://github.com/nazar-pc/php-markdown-next) wrapper for [Laravel 4.1](http://laravel.com).

* Laravel Markdown was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Laravel Markdown relies on Nazar Mokrynskyi's [PHP Markdown Next](https://github.com/nazar-pc/php-markdown-next) package.
* Laravel Markdown uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-Markdown) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-Markdown) to check everything is working.
* Laravel Markdown uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/15243b7d-e94d-45b6-a761-2a9dfb153b1f) to run additional checks.
* Laravel Markdown uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Laravel Markdown provides a [change log](https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Markdown/releases), and [api docs](http://grahamcampbell.github.io/Laravel-Markdown).
* Laravel Markdown is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or HHVM 2.4+ is required.
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel Markdown.


## Installation

Please check the system requirements before installing Laravel Markdown.

To get the latest version of Laravel Markdown, simply require `"graham-campbell/markdown": "1.1.*@dev"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Markdown is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Markdown\MarkdownServiceProvider'`

You can register the Markdown facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'Markdown' => 'GrahamCampbell\Markdown\Facades\Markdown'`


## Configuration

Laravel Markdown requires no configuration. Just follow the simple install instructions and go!


## Usage

**Classes\Markdown**

This is the class of most interest. It is bound to the ioc container as `'markdown'` and can be accessed using the `Facades\Markdown` facade. There is one public method of interest.

The `'render'` method will parse a string as markdown using Nazar Mokrynskyi's [PHP Markdown Next](https://github.com/nazar-pc/php-markdown-next) package, and will return a string of html.

**Facades\Markdown**

This facade will dynamically pass static method calls to the `'markdown'` object in the ioc container which by default is the `Classes\Markdown` class.

**MarkdownServiceProvider**

This class contains no public methods of interest. This class should be added to the providers array in `app/config/app.php`. This class will setup ioc bindings.

**Further Information**

Feel free to check out the [API Documentation](http://grahamcampbell.github.io/Laravel-Markdown
) for Laravel Markdown. You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Laravel Markdown:

    git remote add upstream git://github.com/GrahamCampbell/Laravel-Markdown.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


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
