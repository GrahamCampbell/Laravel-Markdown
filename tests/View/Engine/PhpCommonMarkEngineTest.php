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

use GrahamCampbell\Markdown\View\Engine\PhpCommonMarkEngine;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Filesystem\Filesystem;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Node\Block\Document;
use League\CommonMark\Output\RenderedContent;
use Mockery;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PhpCommonMarkEngineTest extends AbstractTestCase
{
    public function testRender()
    {
        $converter = Mockery::mock(ConverterInterface::class);
        $converter->shouldReceive('convert')->once()->with("qwertyuiop\n")->andReturn(new RenderedContent(new Document(), 'html'));

        $engine = new PhpCommonMarkEngine(new Filesystem(), $converter);

        $this->assertSame('html', $engine->get(__DIR__.'/stubs/test'));
    }
}
