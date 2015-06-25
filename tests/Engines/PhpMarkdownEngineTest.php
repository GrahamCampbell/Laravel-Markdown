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

use GrahamCampbell\Markdown\Engines\PhpMarkdownEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use League\CommonMark\CommonMarkConverter;
use Mockery;

/**
 * This is the php markdown engine test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PhpMarkdownEngineTest extends AbstractTestCase
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
        $markdown = Mockery::mock(CommonMarkConverter::class);

        return new PhpMarkdownEngine($markdown);
    }
}
