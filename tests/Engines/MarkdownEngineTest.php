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

use GrahamCampbell\Markdown\Engines\MarkdownEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the markdown engine test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MarkdownEngineTest extends AbstractTestCase
{
    public function testRender()
    {
        $engine = $this->getEngine();

        $engine->getMarkdown()->shouldReceive('render')->once()
            ->with("qwertyuiop\n")->andReturn('html');

        $return = $engine->get(__DIR__.'/stubs/test');

        $this->assertSame('html', $return);
    }

    protected function getEngine()
    {
        $markdown = Mockery::mock('GrahamCampbell\Markdown\Markdown');

        return new MarkdownEngine($markdown);
    }
}
