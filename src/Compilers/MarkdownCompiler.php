<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown\Compilers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\Compiler;
use Illuminate\View\Compilers\CompilerInterface;
use League\CommonMark\CommonMarkConverter;

/**
 * This is the markdown compiler class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
