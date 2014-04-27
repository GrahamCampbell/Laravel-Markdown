<?php

/**
 * This file is part of Laravel Markdown by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Markdown\Classes;

use Parsedown;

/**
 * This is the markdown class.
 *
 * @package    Laravel-Markdown
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Markdown
 */
class Markdown
{
    /**
     * The parsedown instance.
     *
     * @var \Parsedown
     */
    protected $parsedown;

    /**
     * Create a new instance.
     *
     * @param  \Parsedown  $parsedown
     * @return void
     */
    public function __construct(Parsedown $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    /**
     * Get the parsed markdown.
     *
     * @param  string  $value
     * @return string
     */
    public function render($value)
    {
        return $this->parsedown->text($value);
    }

    /**
     * Return the parsedown instance.
     *
     * @return \Parsedown
     */
    public function getParsedown()
    {
        return $this->parsedown;
    }

    /**
     * Dynamically call all other methods on the parsedown object.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(array($this->parsedown, $method), $parameters);
    }
}
