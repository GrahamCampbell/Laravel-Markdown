Laravel Markdown
================

Laravel Markdown was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [CommonMark](https://github.com/thephpleague/commonmark) wrapper for [Laravel](http://laravel.com). It ships with **integration with Laravel's view system** too. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Markdown/releases), [security policy](https://github.com/GrahamCampbell/Laravel-Markdown/security/policy), [license](LICENSE), [code of conduct](.github/CODE_OF_CONDUCT.md), and [contribution guidelines](.github/CONTRIBUTING.md).

![Banner](https://user-images.githubusercontent.com/2829600/71477505-680d0f80-27e2-11ea-94a6-b4bacb08e270.png)

<p align="center">
<a href="https://github.com/GrahamCampbell/Laravel-Markdown/actions?query=workflow%3ATests"><img src="https://img.shields.io/github/workflow/status/GrahamCampbell/Laravel-Markdown/Tests?label=Tests&style=flat-square" alt="Build Status"></img></a>
<a href="https://github.styleci.io/repos/15090687"><img src="https://github.styleci.io/repos/15090687/shield" alt="StyleCI Status"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen?style=flat-square" alt="Software License"></img></a>
<a href="https://packagist.org/packages/graham-campbell/markdown"><img src="https://img.shields.io/packagist/dt/graham-campbell/markdown?style=flat-square" alt="Packagist Downloads"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Markdown/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Markdown?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

Laravel Markdown requires [PHP](https://php.net) 7.2-8.1. This particular version supports Laravel 6-8.

| Markdown | L5.1               | L5.2               | L5.3               | L5.4               | L5.5               | L5.6               | L5.7               | L5.8               | L6                 | L7                 | L8                 |
|----------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|
| 5.3      | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                |
| 6.1      | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                |
| 7.1      | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                |
| 8.1      | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                |
| 9.0      | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                |
| 10.3     | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                |
| 11.2     | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                |
| 12.0     | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :x:                |
| 13.1     | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: |

To get the latest version, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require graham-campbell/markdown:^13.1
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

This option (`'extensions'`) specifies what extensions will be automatically enabled. Simply provide your extension class names here, and they will be resolved from the service container, and registered with CommonMark. The default value for this setting is `[]`.

##### Renderer Configuration

This option (`'renderer'`) specifies an array of options for rendering HTML. The default value for this setting is `['block_separator' => "\n", 'inner_separator' => "\n", 'soft_break' => "\n"]`.

##### Enable Em Tag Parsing

This option (`'enable_em'`) specifies if `<em>` parsing is enabled. The default value for this setting is `true`.

##### Enable Strong Tag Parsing

This option (`'enable_strong'`) specifies if `<strong>` parsing is enabled. The default value for this setting is `true`.

##### Enable Asterisk Parsing

This option (`'use_asterisk'`) specifies if `*` should be parsed for emphasis. The default value for this setting is `true`.

##### Enable Underscore Parsing

This option (`'use_underscore'`) specifies if `_` should be parsed for emphasis. The default value for this setting is `true`.

##### HTML Input

This option (`'html_input'`) specifies how to handle untrusted HTML input. The default value for this setting is `'strip'`.

##### Allow Unsafe Links

This option (`'allow_unsafe_links'`) specifies whether to allow risky image URLs and links. The default value for this setting is `true`.

##### Maximum Nesting Level

This option (`'max_nesting_level'`) specifies the maximum permitted block nesting level. The default value for this setting is `INF`.


## Usage

##### Facades\Markdown

This facade will dynamically pass static method calls to the `'markdown'` object in the ioc container which by default is an instance of `League\CommonMark\MarkdownConverterInterface`.

##### MarkdownServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use.

```php
use GrahamCampbell\Markdown\Facades\Markdown;

Markdown::convertToHtml('foo'); // <p>foo</p>
```

If you prefer to use dependency injection over facades like me, then you can easily inject the class like so:

```php
use Illuminate\Support\Facades\App;
use League\CommonMark\MarkdownConverterInterface;

class Foo
{
    protected $converter;

    public function __construct(MarkdownConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    public function bar()
    {
        return $this->converter->convertToHtml('foo');
    }
}

App::make('Foo')->bar();
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

As hinted in the configuration docs, CommonMark can be modified using extensions. There are some very good examples in the customization section of the CommonMark docs for how to create custom parsers and renders in the customization section: http://commonmark.thephpleague.com/.

The Smart Punctuation package also serves as a good example of how to implement the full deal: https://github.com/thephpleague/commonmark-ext-smartpunct. In particular, note the presence of the [Extension class](https://github.com/thephpleague/commonmark-ext-smartpunct/blob/v1.1.0/src/SmartPunctExtension.php), and the fact that you can add it to the extensions array in your `app/config/markdown.php` file. If you don't see the file in your config folder, you would need to run `php artisan vendor:publish`.


## Security

If you discover a security vulnerability within this package, please send an email to security@tidelift.com. All security vulnerabilities will be promptly addressed. You may view our full security policy [here](https://github.com/GrahamCampbell/Laravel-Markdown/security/policy).


## License

Laravel Markdown is licensed under [The MIT License (MIT)](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription

The maintainers of `graham-campbell/markdown` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-graham-campbell-markdown?utm_source=packagist-graham-campbell-markdown&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
