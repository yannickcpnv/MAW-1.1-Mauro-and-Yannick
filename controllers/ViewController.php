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
        require_once 'views/pages/' . $page . '.php';
        $content = ob_get_clean();
        require 'views/includes/layout.php';
    }
}