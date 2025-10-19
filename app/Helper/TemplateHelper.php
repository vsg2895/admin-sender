<?php

namespace App\Helper;

class TemplateHelper
{
    public static function convertHtmlToPlainText(string $html): string
    {
        $text = preg_replace('/<\s*(br|\/p)\s*\/?>/i', "\n", $html);
        $text = preg_replace('/<li>(.*?)<\/li>/i', "- $1\n", $text);
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5);
        $text = preg_replace("/\n{2,}/", "\n\n", $text);

        return trim($text);
    }
}
