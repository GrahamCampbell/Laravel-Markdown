<?php
namespace GrahamCampbell\Markdown\Converters;

use GrahamCampbell\Markdown\Responses\MarkdownString;

class Converter extends \League\CommonMark\Converter {
	
	/**
	 * Converts CommonMark to HTML.
	 *
	 * @param string $commonMark
	 *
	 * @return string
	 */
	public function convertToHtml($commonMark)
	{
		$documentAST = $this->docParser->parse($commonMark);
		
		return new MarkdownString($this->htmlRenderer->renderBlock($documentAST));
	}
}