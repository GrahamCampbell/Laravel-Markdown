<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown;

use GrahamCampbell\Markdown\Compilers\MarkdownCompiler;
use GrahamCampbell\Markdown\Engines\BladeMarkdownEngine;
use GrahamCampbell\Markdown\Engines\PhpMarkdownEngine;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;
use Laravel\Lumen\Application as LumenApplication;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;

/**
 * This is the markdown service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $this->setupConfig($this->app);

        if ($this->app->config->get('markdown.views')) {
            $this->enableMarkdownCompiler($this->app);
            $this->enablePhpMarkdownEngine($this->app);
            $this->enableBladeMarkdownEngine($this->app);
        }
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/markdown.php');

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('markdown.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('markdown');
        }

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

            return new PhpMarkdownEngine($markdown);
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

            return new BladeMarkdownEngine($compiler, $markdown);
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
        $this->registerEnvironment($this->app);
        $this->registerMarkdown($this->app);
        $this->registerCompiler($this->app);
    }

    /**
     * Register the environment class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerEnvironment(Application $app)
    {
        $app->singleton('markdown.environment', function ($app) {
            $environment = Environment::createCommonMarkEnvironment();

            $config = $app->config->get('markdown');

            $environment->mergeConfig(array_except($config, ['extensions', 'views']));

            foreach ((array) array_get($config, 'extensions') as $extension) {
                $environment->addExtension($app->make($extension));
            }

            return $environment;
        });

        $app->alias('markdown.environment', Environment::class);
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
            $environment = $app['markdown.environment'];
            $docParser = new DocParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);

            return new Converter($docParser, $htmlRenderer);
        });

        $app->alias('markdown', Converter::class);
    }

    /**
     * Register the markdown compiler class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerCompiler(Application $app)
    {
        $app->singleton('markdown.compiler', function ($app) {
            $markdown = $app['markdown'];
            $files = $app['files'];
            $storagePath = $app->config->get('view.compiled');

            return new MarkdownCompiler($markdown, $files, $storagePath);
        });

        $app->alias('markdown.compiler', MarkdownCompiler::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'markdown.environment',
            'markdown',
            'markdown.compiler',
        ];
    }
}
