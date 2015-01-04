<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testMarkdownIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\Markdown\Markdown');
    }
}
