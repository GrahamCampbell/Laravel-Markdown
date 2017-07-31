Laravel Markdown
================

Laravel Markdown was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [CommonMark](https://github.com/thephpleague/commonmark) wrapper for [Laravel 5](http://laravel.com). It ships with **integration with Laravel's view system** too. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Markdown/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Markdown](https://cloud.githubusercontent.com/assets/2829600/4432292/c10da636-468c-11e4-9ed9-dac778a15cd5.PNG)

<p align="center">
<a href="https://styleci.io/repos/15090687"><img src="https://styleci.io/repos/15090687/shield" alt="StyleCI Status"></img></a>
<a href="https://travis-ci.org/GrahamCampbell/Laravel-Markdown"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-Markdown/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Markdown.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Markdown"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Markdown.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Markdown/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Markdown.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

Laravel Markdown requires [PHP](https://php.net) 7. This particular version supports Laravel 5.1, 5.2, 5.3, 5.4, or 5.5 only.

To get the latest version, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require graham-campbell/markdown
```

Once installed, you need to register the `GrahamCampbell\Markdown\MarkdownServiceProvider` service provider in your `config/app.php`, and optionally alias our facade:

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

This option (`'views'`) specifies if the view integration is enabled so you can write markdown views and have them rendered as html. The following extensions are currently supported: `'.md'`, `'.md.php'`, and `'.md.blade.php'`. You may disable this integration if it is conflicting with another package. The default value for this setting is `true`.

##### CommonMark Extensions

This option (`'extensions'`) specifies what extensions will be automatically enabled. Simply provide your extension class names here. The default value for this setting is `[]`.

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


## Usage

##### Facades\Markdown

This facade will dynamically pass static method calls to the `'markdown'` object in the ioc container which by default is an instance of `League\CommonMark\Converter`.

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
use League\CommonMark\Converter;

class Foo
{
    protected $converter;

    public function __construct(Converter $converter)
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

And don't forget, that's just the basics. We also support extension through listening for the resolving event from the container, and we ship with integration with Laravel's view system.

##### Further Information

There are other classes in this package that are not documented here (such as the engine and compiler classes). This is because they are not intended for public use and are used internally by this package.


### Extensions

As hinted in the configuration docs, CommonMark can be modified using extensions. There are some very good examples in the customization section of the CommonMark docs for how to create custom parsers and renders in the customization section: http://commonmark.thephpleague.com/.

Alt Three's Emoji package also serves as a good example of how to implement the full deal: https://github.com/AltThree/Emoji. In particular, note the presence of the [Extension class](https://github.com/AltThree/Emoji/blob/master/src/EmojiExtension.php), and the fact that you can add it to the extensions array in your `app/config/markdown.php` file. If you don't see the file in your config folder, you would need to run `php artisan vendor:publish`.


## Security

If you discover a security vulnerability within this package, please send an e-mail to Graham Campbell at graham@alt-three.com. All security vulnerabilities will be promptly addressed.


## License

Laravel Markdown is licensed under [The MIT License (MIT)](LICENSE).
