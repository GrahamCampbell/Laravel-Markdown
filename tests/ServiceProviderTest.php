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

use GrahamCampbell\Markdown\Compilers\MarkdownCompiler;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use League\CommonMark\CommonMarkConverter;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testMarkdownIsInjectable()
    {
        $this->assertIsInjectable(CommonMarkConverter::class);
    }

    public function testMarkdownCompilerIsInjectable()
    {
        $this->assertIsInjectable(MarkdownCompiler::class);
    }
}
