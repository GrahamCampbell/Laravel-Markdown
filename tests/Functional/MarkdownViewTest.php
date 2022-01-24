<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Functional;

use GrahamCampbell\Tests\Markdown\AbstractTestCase;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class MarkdownViewTest extends AbstractTestCase
{
    /**
     * Setup the application environment.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->view->addNamespace('stubs', realpath(__DIR__.'/stubs'));
    }

    public function testMarkdown()
    {
        $return = $this->app->view->make('stubs::test')->render();

        $this->assertSame("<h1>Test</h1>\n", $return);
    }

    public function testPhpMarkdown()
    {
        $return = $this->app->view->make('stubs::foo')->render();

        $this->assertSame("<h1>Foo</h1>\n", $return);
    }

    public function testBladeMarkdown()
    {
        $return = $this->app->view->make('stubs::bar')->render();

        $this->assertSame("<h1>Bar</h1>\n", $return);
    }

    public function testBladeDirectiveInline()
    {
        $return = $this->app->view->make('stubs::baz')->render();

        $this->assertSame("<h1>Baz</h1>\n", $return);
    }

    public function testBladeDirectiveBlock1()
    {
        $return = $this->app->view->make('stubs::qux')->render();

        $this->assertSame("<h1>Qux</h1>\n", $return);
    }

    public function testBladeDirectiveBlock2()
    {
        $return = $this->app->view->make('stubs::dir')->render();

        $this->assertSame("<div>\n    <p>foo\nbar</p>\n<pre><code>baz\n</code></pre>\n<p>bat</p>\n</div>\n", $return);
    }

    public function testBladeDirectiveBlock3()
    {
        $return = $this->app->view->make('stubs::bad')->render();

        $this->assertSame("<div>\n    <pre><code>foo\n</code></pre>\n<p>baz</p>\n</div>\n", $return);
    }
}
