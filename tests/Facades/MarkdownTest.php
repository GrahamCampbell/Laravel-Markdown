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

namespace GrahamCampbell\Tests\Markdown\Facades;

use GrahamCampbell\Markdown\Facades\Markdown;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use GrahamCampbell\Tests\Markdown\AbstractTestCase;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\Table\TableExtension;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        return 'markdown.converter';
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
        return ConverterInterface::class;
    }

    public function testConvertToHtml()
    {
        $result = Markdown::convert('foo');

        $this->assertSame("<p>foo</p>\n", $result->getContent());
    }

    public function testDisallowingUnsafeLinks()
    {
        $this->app->config->set('markdown.allow_unsafe_links', false);

        $result = Markdown::convert("[Click me](javascript:alert('XSS'))");

        $this->assertSame("<p><a>Click me</a></p>\n", $result->getContent());
    }

    public function testSmartPuncConversion()
    {
        $this->app->config->set('markdown.extensions', [
            CommonMarkCoreExtension::class,
            TableExtension::class,
            SmartPunctExtension::class,
        ]);

        $result = Markdown::convert("'A', 'B', and 'C' are letters.");

        $this->assertSame("<p>‘A’, ‘B’, and ‘C’ are letters.</p>\n", $result->getContent());
    }
}
