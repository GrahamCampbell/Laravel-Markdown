<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown;

use Illuminate\Support\ServiceProvider;
use ParsedownExtra;

/**
 * This is the markdown service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MarkdownServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/markdown', 'graham-campbell/markdown', __DIR__);

        // setup engines if enabled
        if ($this->app['config']['graham-campbell/markdown::engines']) {
            $this->enableMarkdownEngine();
            $this->enablePhpMarkdownEngine();
            $this->enableBladeMarkdownEngine();
        }
    }

    /**
     * Enable the markdown engine.
     *
     * @return void
     */
    protected function enableMarkdownEngine()
    {
        $app = $this->app;

        // register a new engine
        $app['view']->getEngineResolver()->register('md', function () use ($app) {
            $markdown = $app['markdown'];

            return new Engines\MarkdownEngine($markdown);
        });

        // add the extension
        $app->view->addExtension('md', 'md');
    }

    /**
     * Enable the php markdown engine.
     *
     * @return void
     */
    protected function enablePhpMarkdownEngine()
    {
        $app = $this->app;

        // register a new engine
        $app['view']->getEngineResolver()->register('phpmd', function () use ($app) {
            $markdown = $app['markdown'];

            return new Engines\PhpMarkdownEngine($markdown);
        });

        // add the extension
        $app->view->addExtension('md.php', 'phpmd');
    }

    /**
     * Enable the blade markdown engine.
     *
     * @return void
     */
    protected function enableBladeMarkdownEngine()
    {
        $app = $this->app;

        // register a new engine
        $app['view']->getEngineResolver()->register('blademd', function () use ($app) {
            $compiler = $app['blade.compiler'];
            $markdown = $app['markdown'];

            return new Engines\BladeMarkdownEngine($compiler, $markdown);
        });

        // add the extension
        $app->view->addExtension('md.blade.php', 'blademd');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMarkdown();
    }

    /**
     * Register the markdowm class.
     *
     * @return void
     */
    protected function registerMarkdown()
    {
        $this->app->bindShared('markdown', function ($app) {
            $parsedown = new ParsedownExtra();

            return new Markdown($parsedown);
        });

        $this->app->alias('markdown', 'GrahamCampbell\Markdown\Markdown');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'markdown',
        ];
    }
}
