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

namespace GrahamCampbell\Tests\Markdown\View\Engine;

use GrahamCampbell\Markdown\View\Engine\BladeCommonMarkEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\CompilerInterface;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Node\Block\Document;
use League\CommonMark\Output\RenderedContent;
use Mockery;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class BladeCommonMarkEngineTest extends AbstractTestCase
{
    public function testRender()
    {
        $compiler = Mockery::mock(CompilerInterface::class);
        $compiler->shouldReceive('isExpired')->once()->with(__DIR__.'/stubs/test')->andReturn(false);
        $compiler->shouldReceive('getCompiledPath')->once()->andReturn(__DIR__.'/stubs/test');

        $converter = Mockery::mock(ConverterInterface::class);
        $converter->shouldReceive('convert')->once()->with("qwertyuiop\n")->andReturn(new RenderedContent(new Document(), 'html'));

        $engine = new BladeCommonMarkEngine($compiler, new Filesystem(), $converter);

        $this->assertSame('html', $engine->get(__DIR__.'/stubs/test'));
    }
}
