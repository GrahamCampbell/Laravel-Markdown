<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\HTMLMin;

use GrahamCampbell\Tests\Markdown\AbstractTestCase;

/**
 * This is the markdown view test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MarkdownViewTest extends AbstractTestCase
{
    public function testMarkdown()
    {
        $this->setUpViews();

        $return = $this->app['view']->make('stubs::test')->render();

        $this->assertSame("<h1>Test</h1>\n", $return);
    }

    public function testPhpMarkdown()
    {
        $this->setUpViews();

        $return = $this->app['view']->make('stubs::foo')->render();

        $this->assertSame("<h1>Foo</h1>\n", $return);
    }

    public function testBladeMarkdown()
    {
        $this->setUpViews();

        $return = $this->app['view']->make('stubs::bar')->render();

        $this->assertSame("<h1>Bar</h1>\n", $return);
    }

    protected function setUpViews()
    {
        $this->app['view']->addNamespace('stubs', realpath(__DIR__.'/stubs'));
    }
}
