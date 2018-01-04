<?php
namespace GrahamCampbell\Markdown\Responses;

use Illuminate\Contracts\Support\Htmlable;

class MarkdownString implements Htmlable {
	
	/**
	 * @param string $string
	 */
	public function __construct(string $string) {
		$this->string = $string;
	}
	
	/**
	 * @return string
	 */
	public function toHtml() {
		return $this->string;
	}
	
}