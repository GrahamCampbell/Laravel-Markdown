<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\HTMLMin;

use GrahamCampbell\Tests\Markdown\AbstractTestCase;

/**
 * This is the markdown view test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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

    public function testBladeDirectiveBlock()
    {
        $return = $this->app->view->make('stubs::qux')->render();

        $this->assertSame("<h1>Qux</h1>\n", $return);
    }
}
