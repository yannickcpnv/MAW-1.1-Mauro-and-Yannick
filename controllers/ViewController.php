<?php

namespace Looper\Controllers;

class ViewController
{

    /**
     * Render a view.
     *
     * @param string $page
     * @param array  $values
     */
    public static function renderPage(string $page, array $values = [])
    {
        ob_start();
        $filename = 'views/pages/' . $page . '.php';
        if (file_exists($filename)) {
            require_once $filename;
        } else {
            require_once 'views/pages/404.php';
        }
        $content = ob_get_clean();
        require 'views/includes/layout.php';
    }

    protected function render(string $page, array $values = [])
    {
        self::renderPage($page, $values);
    }
}