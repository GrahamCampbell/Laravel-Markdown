<?php

/**
 * This file is part of Laravel Markdown by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Markdown;

use Illuminate\Support\ServiceProvider;
use ParsedownExtra;

/**
 * This is the markdown service provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
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
        return array(
            'markdown',
        );
    }
}
