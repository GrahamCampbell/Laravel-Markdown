<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Engines;

use GrahamCampbell\Markdown\Engines\BladeMarkdownEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the blade markdown engine test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
        $compiler = Mockery::mock('Illuminate\View\Compilers\CompilerInterface');
        $markdown = Mockery::mock('League\CommonMark\CommonMarkConverter');

        $compiler->shouldReceive('isExpired')->once()
            ->with(__DIR__.'/stubs/test')->andReturn(false);
        $compiler->shouldReceive('getCompiledPath')->once()
            ->andReturn(__DIR__.'/stubs/test');

        return new BladeMarkdownEngine($compiler, $markdown);
    }
}
