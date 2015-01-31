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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;
use League\CommonMark\CommonMarkConverter;

/**
 * This is the markdown service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MarkdownServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();

        if ($this->app->config->get('markdown.views')) {
            $this->enableMarkdownCompiler($this->app);
            $this->enablePhpMarkdownEngine($this->app);
            $this->enableBladeMarkdownEngine($this->app);
        }
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/markdown.php');

        $this->publishes([$source => config_path('markdown.php')]);

        $this->mergeConfigFrom($source, 'markdown');
    }

    /**
     * Enable the markdown compiler.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function enableMarkdownCompiler(Application $app)
    {
        $app->view->getEngineResolver()->register('md', function () use ($app) {
            $compiler = $app['markdown.compiler'];

            return new CompilerEngine($compiler);
        });

        $app->view->addExtension('md', 'md');
    }

    /**
     * Enable the php markdown engine.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function enablePhpMarkdownEngine(Application $app)
    {
        $app->view->getEngineResolver()->register('phpmd', function () use ($app) {
            $markdown = $app['markdown'];

            return new Engines\PhpMarkdownEngine($markdown);
        });

        $app->view->addExtension('md.php', 'phpmd');
    }

    /**
     * Enable the blade markdown engine.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function enableBladeMarkdownEngine(Application $app)
    {
        $app->view->getEngineResolver()->register('blademd', function () use ($app) {
            $compiler = $app['blade.compiler'];
            $markdown = $app['markdown'];

            return new Engines\BladeMarkdownEngine($compiler, $markdown);
        });

        $app->view->addExtension('md.blade.php', 'blademd');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMarkdown($this->app);
        $this->registerMarkdownCompiler($this->app);
    }

    /**
     * Register the markdowm class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerMarkdown(Application $app)
    {
        $app->singleton('markdown', function ($app) {
            return new CommonMarkConverter();
        });

        $app->alias('markdown', 'League\CommonMark\CommonMarkConverter');
    }

    /**
     * Register the markdown compiler class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerMarkdownCompiler(Application $app)
    {
        $app->singleton('markdown.compiler', function ($app) {
            $markdown = $app['markdown'];
            $files = $app['files'];
            $storagePath = $app->config->get('view.compiled');

            return new Compilers\MarkdownCompiler($markdown, $files, $storagePath);
        });

        $app->alias('markdown.compiler', 'GrahamCampbell\Markdown\Compilers\MarkdownCompiler');
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
            'markdown.compiler',
        ];
    }
}
