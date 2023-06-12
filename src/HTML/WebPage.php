<?php

namespace Html;

class WebPage
{
    private string $head ="";
    private string $title ="";
    private string $body ="";

    public function __construct(string $title = '')
    {

        $this->title = $title ;
    }

    public function appendContent(string $content): void
    {
        $this->body.= $content;
    }

    public function appendCss(string $css): void
    {
        $style =<<<HTML
                    <style> 
                        {$css}
                    </style>

        HTML;
        $this->head .= $style;
    }

    public function appendCssUrl(string $url): void
    {
        $link =<<<HTML
        <link rel="stylesheet" media="screen" href="{$url}">

        HTML;
        $this -> head .= $link ;
    }

    public function appendJs(string $js): void
    {
        $script=<<<HTML
        <script>
        {$js}
        </script>

        HTML;
        $this->head.=$script;
    }

    public function appendJsUrl(string $url): void
    {
        $link =<<<HTML
        <script src="{$url}"></script>

        HTML;
        $this -> head .= $link ;
    }


    public function appendToHead(string $content): void
    {
        $this -> head .= $content ;

    }

    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_HTML5|ENT_QUOTES);
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getHead(): string
    {
        return $this->head ;
    }

    public static function getLastModififcation(): string
    {
        $edit = getlastmod();
        return date('l jS \of F Y h:i:s A', $edit);
    }

    public function getTiltle(): string
    {
        return $this ->title;
    }

    public function setTitle(string $title): void
    {
        $this -> title = $title;
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!doctype html> 
        <html lang="fr">
            <head>
                <meta name="viewport" content="initial-scale=1, maximum-scale=1">
                <meta charset="UTF-8">
                {$this->head}
                <title>
                    {$this->title}
                </title>
            </head>
            <body>
                {$this->body}
            </body>
        </html> 

        HTML;

    }


}
