<?php

/*
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

namespace GrahamCampbell\Markdown\Engines;

use Illuminate\View\Engines\EngineInterface;
use League\CommonMark\CommonMarkConverter;

/**
 * This is the markdown engine class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
 */
class MarkdownEngine implements EngineInterface
{
    /**
     * The markdown instance.
     *
     * @var \League\CommonMark\CommonMarkConverter
     */
    protected $markdown;

    /**
     * Create a new instance.
     *
     * @param \League\CommonMark\CommonMarkConverter $markdown
     *
     * @return void
     */
    public function __construct(CommonMarkConverter $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param string $path
     * @param array  $data
     *
     * @return string
     */
    public function get($path, array $data = [])
    {
        $contents = file_get_contents($path);

        return $this->markdown->convertToHtml($contents);
    }

    /**
     * Return the markdown instance.
     *
     * @return \League\CommonMark\CommonMarkConverter
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }
}
