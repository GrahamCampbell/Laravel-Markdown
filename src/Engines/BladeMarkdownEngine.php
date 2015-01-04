<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown\Engines;

use GrahamCampbell\Markdown\Markdown;
use Illuminate\View\Compilers\CompilerInterface;
use Illuminate\View\Engines\CompilerEngine;

/**
 * This is the php markdown engine class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class BladeMarkdownEngine extends CompilerEngine
{
    /**
     * The markdown instance.
     *
     * @var \GrahamCampbell\Markdown\Markdown
     */
    protected $markdown;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\View\Compilers\CompilerInterface $compiler
     * @param \GrahamCampbell\Markdown\Markdown            $markdown
     *
     * @return void
     */
    public function __construct(CompilerInterface $compiler, Markdown $markdown)
    {
        parent::__construct($compiler);
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
        $contents = parent::get($path, $data);

        return $this->markdown->render($contents);
    }

    /**
     * Return the markdown instance.
     *
     * @return \GrahamCampbell\Markdown\Markdown
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }
}
