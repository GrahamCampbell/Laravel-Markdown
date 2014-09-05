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

namespace GrahamCampbell\Tests\Markdown;

use Mockery;
use GrahamCampbell\Markdown\Markdown;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;

/**
 * This is the markdown test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
 */
class MarkdownTest extends AbstractTestBenchTestCase
{
    public function testRender()
    {
        $markdown = $this->getMarkdown();

        $markdown->getParsedown()->shouldReceive('text')->once()
            ->with('test')->andReturn('html');

        $return = $markdown->render('test');

        $this->assertSame('html', $return);
    }

    protected function getMarkdown()
    {
        $parsedown = Mockery::mock('ParsedownExtra');

        return new Markdown($parsedown);
    }
}
