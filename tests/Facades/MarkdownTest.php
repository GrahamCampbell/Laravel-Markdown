<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Facades;

use GrahamCampbell\Markdown\Facades\Markdown;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use GrahamCampbell\Tests\Markdown\AbstractTestCase;
use League\CommonMark\CommonMarkConverter;

/**
 * This is the markdown facade test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class MarkdownTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'markdown';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Markdown::class;
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return CommonMarkConverter::class;
    }

    public function testConvertToHtml()
    {
        $result = Markdown::convertToHtml('foo');

        $this->assertSame("<p>foo</p>\n", $result);
    }
}
