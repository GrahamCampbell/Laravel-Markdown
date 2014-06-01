<?php

/**
 * This file is part of Laravel Markdown by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
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
 * @package    Laravel-Markdown
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Markdown
 */
class MarkdownViewTest extends AbstractTestCase
{
    public function testMarkdown()
    {
        $this->setUpViews();

        $return = $this->app['view']->make('stubs::test')->render();

        $this->assertEquals('<h1>Test</h1>', $return);
    }

    public function testPhpMarkdown()
    {
        $this->setUpViews();

        $return = $this->app['view']->make('stubs::foo')->render();

        $this->assertEquals('<h1>Foo</h1>', $return);
    }

    public function testBladeMarkdown()
    {
        $this->setUpViews();

        $return = $this->app['view']->make('stubs::bar')->render();

        $this->assertEquals('<h1>Bar</h1>', $return);
    }

    protected function setUpViews()
    {
        $this->app['view']->addNamespace('stubs', realpath(__DIR__.'/stubs'));
    }
}
