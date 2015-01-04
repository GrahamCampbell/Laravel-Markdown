<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Markdown\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use GrahamCampbell\Tests\Markdown\AbstractTestCase;

/**
 * This is the markdown facade test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MarkdownTest extends AbstractTestCase
{
    use FacadeTestCaseTrait;

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
        return 'GrahamCampbell\Markdown\Facades\Markdown';
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return 'GrahamCampbell\Markdown\Markdown';
    }
}
