<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown\Engines;

use Illuminate\View\Compilers\CompilerInterface;
use Illuminate\View\Engines\CompilerEngine;
use League\CommonMark\Converter;

/**
 * This is the php markdown engine class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BladeMarkdownEngine extends CompilerEngine
{
    /**
     * The markdown instance.
     *
     * @var \League\CommonMark\Converter
     */
    protected $markdown;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\View\Compilers\CompilerInterface $compiler
     * @param \League\CommonMark\Converter                 $markdown
     *
     * @return void
     */
    public function __construct(CompilerInterface $compiler, Converter $markdown)
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

        return $this->markdown->convertToHtml($contents);
    }

    /**
     * Return the markdown instance.
     *
     * @return \League\CommonMark\Converter
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }
}
