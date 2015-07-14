<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Engines;

use GrahamCampbell\Markdown\Engines\BladeMarkdownEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\View\Compilers\CompilerInterface;
use League\CommonMark\Converter;
use Mockery;

/**
 * This is the blade markdown engine test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BladeMarkdownEngineTest extends AbstractTestCase
{
    public function testRender()
    {
        $engine = $this->getEngine();

        $engine->getMarkdown()->shouldReceive('convertToHtml')->once()
            ->with("qwertyuiop\n")->andReturn('html');

        $return = $engine->get(__DIR__.'/stubs/test');

        $this->assertSame('html', $return);
    }

    protected function getEngine()
    {
        $compiler = Mockery::mock(CompilerInterface::class);
        $markdown = Mockery::mock(Converter::class);

        $compiler->shouldReceive('isExpired')->once()
            ->with(__DIR__.'/stubs/test')->andReturn(false);
        $compiler->shouldReceive('getCompiledPath')->once()
            ->andReturn(__DIR__.'/stubs/test');

        return new BladeMarkdownEngine($compiler, $markdown);
    }
}
