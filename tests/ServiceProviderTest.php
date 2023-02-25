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

namespace GrahamCampbell\Tests\Markdown;

use GrahamCampbell\Markdown\View\Compiler\CommonMarkCompiler;
use GrahamCampbell\Markdown\View\Directive\CommonMarkDirective;
use GrahamCampbell\Markdown\View\Directive\DirectiveInterface;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentInterface;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testEnvironmentIsInjectable(): void
    {
        self::assertIsInjectable(Environment::class);
        self::assertIsInjectable(EnvironmentInterface::class);
    }

    public function testMarkdownIsInjectable(): void
    {
        self::assertIsInjectable(CommonMarkConverter::class);
        self::assertIsInjectable(ConverterInterface::class);
    }

    public function testCompilerIsInjectable(): void
    {
        self::assertIsInjectable(CommonMarkCompiler::class);
    }

    public function testDirectiveIsInjectable(): void
    {
        self::assertIsInjectable(CommonMarkDirective::class);
        self::assertIsInjectable(DirectiveInterface::class);
    }
}
