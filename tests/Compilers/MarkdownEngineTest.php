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

namespace GrahamCampbell\Tests\Markdown\Compilers;

use GrahamCampbell\Markdown\Compilers\MarkdownCompiler;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the markdown compiler test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
 */
class MarkdownCompilerTest extends AbstractTestCase
{
    public function testCompile()
    {
        $compiler = $this->getCompiler();

        $compiler->getFiles()->shouldReceive('get')->once()
            ->with('path')->andReturn('markdown');

        $compiler->getMarkdown()->shouldReceive('convertToHtml')->once()
            ->with("markdown")->andReturn('html');

        $compiler->getFiles()->shouldReceive('put')->once()
            ->with(__DIR__.'/d6fe1d0be6347b8ef2427fa629c04485', 'html');

        $this->assertNull($compiler->compile('path'));
    }

    protected function getCompiler()
    {
        $markdown = Mockery::mock('League\CommonMark\CommonMarkConverter');
        $files = Mockery::mock('Illuminate\Filesystem\Filesystem');
        $cachePath = __DIR__;

        return new MarkdownCompiler($markdown, $files, $cachePath);
    }
}
