Laravel Markdown
================

Laravel Markdown was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [CommonMark](https://github.com/thephpleague/commonmark) wrapper for [Laravel](https://laravel.com/). It ships with **integration with Laravel's view system** too. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Markdown/releases), [security policy](https://github.com/GrahamCampbell/Laravel-Markdown/security/policy), [license](LICENSE), [code of conduct](.github/CODE_OF_CONDUCT.md), and [contribution guidelines](.github/CONTRIBUTING.md).

![Banner](https://user-images.githubusercontent.com/2829600/71477505-680d0f80-27e2-11ea-94a6-b4bacb08e270.png)

<p align="center">
<a href="https://github.com/GrahamCampbell/Laravel-Markdown/actions?query=workflow%3ATests"><img src="https://img.shields.io/github/actions/workflow/status/GrahamCampbell/Laravel-Markdown/tests.yml?label=Tests&style=flat-square" alt="Build Status"></img></a>
<a href="https://github.styleci.io/repos/15090687"><img src="https://github.styleci.io/repos/15090687/shield" alt="StyleCI Status"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen?style=flat-square" alt="Software License"></img></a>
<a href="https://packagist.org/packages/graham-campbell/markdown"><img src="https://img.shields.io/packagist/dt/graham-campbell/markdown?style=flat-square" alt="Packagist Downloads"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Markdown/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Markdown?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

This version requires [PHP](https://www.php.net/) 7.4-8.2 and supports [Laravel](https://laravel.com/) 8-10.

| Markdown | L5.5               | L5.6               | L5.7               | L5.8               | L6                 | L7                 | L8                 | L9                 | L10                |
|----------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|
| 10.3     | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                | :x:                | :x:                |
| 11.2     | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                |
| 12.0     | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                |
| 13.1     | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                |
| 14.0     | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :x:                |
| 15.0     | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: |

To get the latest version, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require "graham-campbell/markdown:^15.0"
```

Once installed, if you are not using automatic package discovery, then you need to register the `GrahamCampbell\Markdown\MarkdownServiceProvider` service provider in your `config/app.php`.

You can also optionally alias our facade:

```php
        'Markdown' => GrahamCampbell\Markdown\Facades\Markdown::class,
```


## Configuration

Laravel Markdown supports optional configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/markdown.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are several config options:

##### Enable View Integration

This option (`'views'`) specifies if the view integration is enabled so you can write markdown views and have them rendered as html. The following extensions are currently supported: `'.md'`, `'.md.php'`, and `'.md.blade.php'`. Additionally, this will enable the `@markdown` Blade directive. You may disable this integration if it is conflicting with another package. The default value for this setting is `true`.

##### CommonMark Extensions

This option (`'extensions'`) specifies what extensions will be automatically enabled. Simply provide your extension class names here, and they will be resolved from the service container, and registered with CommonMark. The default value for this setting is `[League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class, League\CommonMark\Extension\Table\TableExtension::class]`.

##### Renderer Configuration

This option (`'renderer'`) specifies an array of options for rendering HTML. The default value for this setting is `['block_separator' => "\n", 'inner_separator' => "\n", 'soft_break' => "\n"]`.

##### CommonMark Configuration

This option (`'commonmark'`) specifies an array of options for commonmark. The default value for this setting is `['enable_em' => true, 'enable_strong' => true, 'use_asterisk' => true, 'use_underscore' => true, 'unordered_list_markers' => ['-', '+', '*']]`.

##### HTML Input

This option (`'html_input'`) specifies how to handle untrusted HTML input. The default value for this setting is `'strip'`.

##### Allow Unsafe Links

This option (`'allow_unsafe_links'`) specifies whether to allow risky image URLs and links. The default value for this setting is `true`.

##### Maximum Nesting Level

This option (`'max_nesting_level'`) specifies the maximum permitted block nesting level. The default value for this setting is `PHP_INT_MAX`.

##### Slug Normalizer

This option (`'slug_normalizer'`) specifies an array of options for slug normalization. The default value for this setting is `['max_length' => 255, 'unique' => 'document']`.


## Usage

##### Facades\Markdown

This facade will dynamically pass static method calls to the `'markdown.converter'` object in the ioc container which by default is an instance of `League\CommonMark\ConverterInterface`.

##### MarkdownServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use.

```php
use GrahamCampbell\Markdown\Facades\Markdown;

Markdown::convert('foo')->getContent(); // <p>foo</p>
```

If you prefer to use dependency injection over facades like me, then you can easily inject the class like so:

```php
use League\CommonMark\ConverterInterface;

class Foo
{
    private ConverterInterface $converter;

    public function __construct(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    public function bar(): string
    {
        return $this->converter->convert('foo')->getContent();
    }
}

app(Foo::class)->bar();
```

And don't forget, that's just the basics. We also support extension through listening for the resolving event from the container, and we ship with integration with Laravel's view system. You can use both the `@markdown` blade directive, and also using the following file extensions will compile your views as markdown: `'.md'`, `'.md.php'`, and `'.md.blade.php'`.

For example, the following are all methods of rendering markdown:

*`foo.blade.php`*:
```blade
@markdown('# Foo')
```

*`bar.blade.php`*:
```blade
@markdown
# Bar
@endmarkdown
```

*`baz1.md`*:
```
# Baz 1
```

*`baz2.md.php`*:
```
# Baz 2
```

*`baz3.md.blade.php`*:
```
# Baz 3
```

##### Further Information

There are other classes in this package that are not documented here (such as the engine and compiler classes). This is because they are not intended for public use and are used internally by this package.


### Extensions

As hinted in the configuration docs, CommonMark can be modified using extensions. There are some very good examples in the customization section of the CommonMark docs for how to create custom parsers and renders in the customization section: https://commonmark.thephpleague.com/.


## Security

If you discover a security vulnerability within this package, please send an email to security@tidelift.com. All security vulnerabilities will be promptly addressed. You may view our full security policy [here](https://github.com/GrahamCampbell/Laravel-Markdown/security/policy).


## License

Laravel Markdown is licensed under [The MIT License (MIT)](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription

The maintainers of `graham-campbell/markdown` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-graham-campbell-markdown?utm_source=packagist-graham-campbell-markdown&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
