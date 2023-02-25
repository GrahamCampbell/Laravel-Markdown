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

use GrahamCampbell\Markdown\View\Compiler\CommonMarkCompiler;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Node\Block\Document;
use League\CommonMark\Output\RenderedContent;
use Mockery;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class CommonMarkCompilerTest extends AbstractTestCase
{
    public function testCompile(): void
    {
        $converter = Mockery::mock(ConverterInterface::class);
        $converter->shouldReceive('convert')->once()->with('markdown')->andReturn(new RenderedContent(new Document(), 'html'));

        $files = Mockery::mock(Filesystem::class);
        $files->shouldReceive('get')->once()->with('path')->andReturn('markdown');

        if (10 === (int) Application::VERSION) {
            $files->shouldReceive('put')->once()->with(__DIR__.'/b5ee0bc34d1063d878b5fea7206bb2f5.php', 'html');
        } else {
            $files->shouldReceive('put')->once()->with(__DIR__.'/e13dbc54cb72a29f66053c494f2c456242d1fefa.php', 'html');
        }

        $compiler = new CommonMarkCompiler($converter, $files, __DIR__);

        self::assertNull($compiler->compile('path'));
    }
}
