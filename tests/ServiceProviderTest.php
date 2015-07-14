<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown;

use GrahamCampbell\Markdown\Compilers\MarkdownCompiler;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use League\CommonMark\Converter;
use League\CommonMark\Environment;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testEnvironmentIsInjectable()
    {
        $this->assertIsInjectable(Environment::class);
    }

    public function testMarkdownIsInjectable()
    {
        $this->assertIsInjectable(Converter::class);
    }

    public function testCompilerIsInjectable()
    {
        $this->assertIsInjectable(MarkdownCompiler::class);
    }
}
