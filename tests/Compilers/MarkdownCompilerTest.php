<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Compilers;

use GrahamCampbell\Markdown\Compilers\MarkdownCompiler;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the markdown compiler test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
