<?php

namespace Peto16\Textfilter;

/**
 * Textfilter test class with test cases.
 *
 */

class TextfilterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatToHtml()
    {
        // Test nl to br
        $textFilter = new \Peto16\Textfilter\Textfilter();
        $this->assertEquals("<br>\n", $textFilter->formatToHtml("\n", "nl2br"));

        $this->assertEquals("<strong>Bold</strong>", $textFilter->formatToHtml("[b]Bold[/b]", "bbcode"));

        // Test url
        $url = "<a href='https://dbwebb.se'>https://dbwebb.se</a>";
        $testUrl = $textFilter->formatToHtml("https://dbwebb.se", "link");
        $this->assertSame($url, $testUrl);

        //Markdown
        $this->assertEquals("<p><strong>Bold</strong></p>\n", $textFilter->formatToHtml("**Bold**", "markdown"));

        //esc
        $this->assertEquals("&lt;script&gt;alert('test');&lt;\/script&gt;", $textFilter->formatToHtml("<script>alert('test');<\/script>", "esc"));
    }


    public function testFormatToHtmlStrip()
    {
        $textFilter = new \Peto16\Textfilter\Textfilter();
        $this->assertEquals("En <strong>rund</strong> boll.", $textFilter->formatToHtmlStrip("En<br> [b]rund[/b] boll.", "bbcode"));
    }
}
