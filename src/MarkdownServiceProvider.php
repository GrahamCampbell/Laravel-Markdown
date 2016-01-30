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
use Illuminate\Contracts\Container\Container;
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
        $this->setupConfig();

        if ($this->app->config->get('markdown.views')) {
            $this->enableMarkdownCompiler();
            $this->enablePhpMarkdownEngine();
            $this->enableBladeMarkdownEngine();
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

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('markdown.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('markdown');
        }

        $this->mergeConfigFrom($source, 'markdown');
    }

    /**
     * Enable the markdown compiler.
     *
     * @return void
     */
    protected function enableMarkdownCompiler()
    {
        $app = $this->app;

        $app->view->getEngineResolver()->register('md', function () use ($app) {
            $compiler = $app['markdown.compiler'];

            return new CompilerEngine($compiler);
        });

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

        $app->view->getEngineResolver()->register('phpmd', function () use ($app) {
            $markdown = $app['markdown'];

            return new PhpMarkdownEngine($markdown);
        });

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
        $this->registerEnvironment();
        $this->registerMarkdown();
        $this->registerCompiler();
    }

    /**
     * Register the environment class.
     *
     * @return void
     */
    protected function registerEnvironment()
    {
        $this->app->singleton('markdown.environment', function (Container $app) {
            $environment = Environment::createCommonMarkEnvironment();

            $config = $app->config->get('markdown');

            $environment->mergeConfig(array_except($config, ['extensions', 'views']));

            foreach ((array) array_get($config, 'extensions') as $extension) {
                $environment->addExtension($app->make($extension));
            }

            return $environment;
        });

        $this->app->alias('markdown.environment', Environment::class);
    }

    /**
     * Register the markdowm class.
     *
     * @return void
     */
    protected function registerMarkdown()
    {
        $this->app->singleton('markdown', function (Container $app) {
            $environment = $app['markdown.environment'];
            $docParser = new DocParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);

            return new Converter($docParser, $htmlRenderer);
        });

        $this->app->alias('markdown', Converter::class);
    }

    /**
     * Register the markdown compiler class.
     *
     * @return void
     */
    protected function registerCompiler()
    {
        $this->app->singleton('markdown.compiler', function (Container $app) {
            $markdown = $app['markdown'];
            $files = $app['files'];
            $storagePath = $app->config->get('view.compiled');

            return new MarkdownCompiler($markdown, $files, $storagePath);
        });

        $this->app->alias('markdown.compiler', MarkdownCompiler::class);
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
