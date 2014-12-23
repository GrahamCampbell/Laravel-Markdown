<?php

/*
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

namespace GrahamCampbell\Tests\Markdown\HTMLMin;

use GrahamCampbell\Tests\Markdown\AbstractTestCase;

/**
 * This is the markdown view test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
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
