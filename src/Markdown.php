<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown;

use ParsedownExtra;

/**
 * This is the markdown class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Markdown
{
    /**
     * The parsedown extra instance.
     *
     * @var \ParsedownExtra
     */
    protected $parsedown;

    /**
     * Create a new instance.
     *
     * @param \ParsedownExtra $parsedown
     *
     * @return void
     */
    public function __construct(ParsedownExtra $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    /**
     * Get the parsed markdown.
     *
     * @param string $value
     *
     * @return string
     */
    public function render($value)
    {
        return $this->parsedown->text($value);
    }

    /**
     * Return the parsedown extra instance.
     *
     * @return \ParsedownExtra
     */
    public function getParsedown()
    {
        return $this->parsedown;
    }
}
