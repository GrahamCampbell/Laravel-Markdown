<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testMarkdownIsInjectable()
    {
        $this->assertIsInjectable('League\CommonMark\CommonMarkConverter');
    }

    public function testMarkdownCompilerIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\Markdown\Compilers\MarkdownCompiler');
    }
}
