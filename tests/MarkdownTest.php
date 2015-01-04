<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown;

use GrahamCampbell\Markdown\Markdown;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;

/**
 * This is the markdown test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MarkdownTest extends AbstractTestBenchTestCase
{
    public function testRender()
    {
        $markdown = $this->getMarkdown();

        $markdown->getParsedown()->shouldReceive('text')->once()
            ->with('test')->andReturn('html');

        $return = $markdown->render('test');

        $this->assertSame('html', $return);
    }

    protected function getMarkdown()
    {
        $parsedown = Mockery::mock('ParsedownExtra');

        return new Markdown($parsedown);
    }
}
