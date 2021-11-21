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

use GrahamCampbell\Markdown\View\Engine\BladeMarkdownEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\View\Compilers\CompilerInterface;
use League\CommonMark\MarkdownConverterInterface;
use Mockery;

/**
 * This is the blade markdown engine test class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        $markdown = Mockery::mock(MarkdownConverterInterface::class);

        $compiler->shouldReceive('isExpired')->once()
            ->with(__DIR__.'/stubs/test')->andReturn(false);
        $compiler->shouldReceive('getCompiledPath')->once()
            ->andReturn(__DIR__.'/stubs/test');

        return new BladeMarkdownEngine($compiler, $markdown);
    }
}
