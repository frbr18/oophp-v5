<?php

namespace Frbr18\Textfilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class TextfilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function indexAction()
    {
        $this->app->page->add("textfilter/navbar");
        return $this->app->page->render([
            "title" => "Textfilter"
        ]);
    }

    public function markdownAction()
    {
        $textFilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../text/sample.md");
        $html = $textFilter->markdown($text);
        $this->app->page->add("textfilter/markdown", [
            "html" => $html,
            "text" => $text
        ]);
        return $this->app->page->render([
            "title" => "Textfilter | Markdown"
        ]);
    }

    public function bbcodeAction()
    {
        $textFilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../text/bbcode.txt");
        $html = $textFilter->bbcode2html($text);
        $this->app->page->add("textfilter/bbcode", [
            "html" => $html,
            "text" => $text
        ]);
        return $this->app->page->render([
            "title" => "Textfilter | Markdown"
        ]);
    }

    public function clickableAction()
    {
        $textFilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../text/clickable.txt");
        $html = $textFilter->makeClickable($text);
        $this->app->page->add("textfilter/clickable", [
            "html" => $html,
            "text" => $text
        ]);
        return $this->app->page->render([
            "title" => "Textfilter | Markdown"
        ]);
    }
}
