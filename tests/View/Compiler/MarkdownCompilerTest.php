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

namespace GrahamCampbell\Tests\Markdown\View\Compiler;

use GrahamCampbell\Markdown\View\Compiler\MarkdownCompiler;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use League\CommonMark\MarkdownConverterInterface;
use Mockery;

/**
 * This is the markdown compiler test class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        $markdown = Mockery::mock(MarkdownConverterInterface::class);
        $files = Mockery::mock(Filesystem::class);
        $cachePath = __DIR__;

        return new MarkdownCompiler($markdown, $files, $cachePath);
    }
}
