<?php


namespace core;


class Templater
{
    public static function buildHtmlView($template, $params = [])
    {
        extract($params);
        ob_start();
        include_once  sprintf('view\%s.php', $template);

        return ob_get_clean();
    }
}