<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Facades;

use GrahamCampbell\Markdown\Facades\Markdown;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use GrahamCampbell\Tests\Markdown\AbstractTestCase;
use League\CommonMark\Converter;

/**
 * This is the markdown facade test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return Converter::class;
    }

    public function testConvertToHtml()
    {
        $result = Markdown::convertToHtml('foo');

        $this->assertSame("<p>foo</p>\n", $result);
    }

    public function testSafeConversion()
    {
        $this->app->config->set('markdown.safe', true);

        $result = Markdown::convertToHtml("[Click me](javascript:alert('XSS'))");

        $this->assertSame("<p><a>Click me</a></p>\n", $result);
    }
}
