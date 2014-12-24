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

namespace GrahamCampbell\Markdown\Compilers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\Compiler;
use Illuminate\View\Compilers\CompilerInterface;
use League\CommonMark\CommonMarkConverter;

/**
 * This is the markdown compiler class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Markdown/blob/master/LICENSE.md> Apache 2.0
 */
class MarkdownCompiler extends Compiler implements CompilerInterface
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
     * @param \Illuminate\Filesystem\Filesystem      $files
     * @param string                                 $cachePath
     *
     * @return void
     */
    public function __construct(CommonMarkConverter $markdown, Filesystem $files, $cachePath)
    {
        parent::__construct($files, $cachePath);

        $this->markdown = $markdown;
    }

    /**
     * Compile the view at the given path.
     *
     * @param string $path
     *
     * @return void
     */
    public function compile($path)
    {
        $contents = $this->markdown->convertToHtml($this->files->get($path));

        $this->files->put($this->getCompiledPath($path), $contents);
    }

    /**
     * Return the filesystem instance.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    public function getFiles()
    {
        return $this->files;
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
