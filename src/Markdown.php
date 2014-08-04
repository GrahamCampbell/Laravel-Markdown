<?php

/**
 * This file is part of Laravel Markdown by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Markdown;

use ParsedownExtra;

/**
 * This is the markdown class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
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
