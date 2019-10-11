<?php

namespace Vanilla\Formatting\Formats;

use Vanilla\Formatting\Html\HtmlEnhancer;
use Vanilla\Formatting\Html\HtmlPlainTextConverter;
use Vanilla\Formatting\Html\HtmlSanitizer;


class HtmlBBCodeFormat extends HtmlFormat {

    const FORMAT_KEY = "bbcode";

    private $bbcodeParser;

    public function __construct(
        \BBCode $bbcodeParser,
        HtmlSanitizer $htmlSanitizer,
        HtmlEnhancer $htmlEnhancer,
        HtmlPlainTextConverter $plainTextConverter
    ) {
        $plainTextConverter->setAddNewLinesAfterDiv(true);
        $htmlSanitizer->setShouldEncodeCodeBlocks(false);
        parent::__construct($htmlSanitizer, $htmlEnhancer, $plainTextConverter, false);
        $this->bbcodeParser = $bbcodeParser;
    }


    public function renderHtml(string $value, bool $enhance = true): string {
        // Ignore HTML tags
        $this->bbcodeParser->nbbc()->setEscapeContent(false);
        // DO handle line breaks
        $this->bbcodeParser->nbbc()->setIgnoreNewlines(false);
        // Parse BBCode
        $renderedBBCode = $this->bbcodeParser->format($value);
        return parent::renderHtml($renderedBBCode, $enhance);
    }


    public function renderQuote(string $value): string {
        // Ignore HTML tags
        $this->bbcodeParser->nbbc()->setEscapeContent(false);
        // DO handle line breaks
        $this->bbcodeParser->nbbc()->setIgnoreNewlines(false);
        // Parse BBCode
        $renderedBBCode = $this->bbcodeParser->format($value);
        return parent::renderQuote($renderedBBCode);
    }
}
