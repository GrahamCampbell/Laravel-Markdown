<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Compilers;

use GrahamCampbell\Markdown\Compilers\MarkdownCompiler;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Filesystem\Filesystem;
use League\CommonMark\Converter;
use Mockery;

/**
 * This is the markdown compiler test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MarkdownCompilerTest extends AbstractTestCase
{
    public function testCompile()
    {
        $compiler = $this->getCompiler();

        $compiler->getFiles()->shouldReceive('get')->once()
            ->with('path')->andReturn('markdown');

        $compiler->getMarkdown()->shouldReceive('convertToHtml')->once()
            ->with('markdown')->andReturn('html');

        if (substr(Application::VERSION, 0, 3) === '5.1') {
            $file = 'd6fe1d0be6347b8ef2427fa629c04485';
        } else {
            $file = '3150ecd5e0294534a81ae047ddac559de481d774.php';
        }

        $compiler->getFiles()->shouldReceive('put')->once()
            ->with(__DIR__.'/'.$file, 'html');

        $this->assertNull($compiler->compile('path'));
    }

    protected function getCompiler()
    {
        $markdown = Mockery::mock(Converter::class);
        $files = Mockery::mock(Filesystem::class);
        $cachePath = __DIR__;

        return new MarkdownCompiler($markdown, $files, $cachePath);
    }
}
