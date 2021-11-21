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

use GrahamCampbell\Markdown\View\Engine\PhpMarkdownEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use League\CommonMark\MarkdownConverterInterface;
use Mockery;

/**
 * This is the php markdown engine test class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        $markdown = Mockery::mock(MarkdownConverterInterface::class);

        return new PhpMarkdownEngine($markdown);
    }
}
