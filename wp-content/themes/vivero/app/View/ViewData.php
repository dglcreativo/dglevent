<?php

class ViewData {

    static function renderTemplate(string $name, array $data = []) {
        ob_start();
        //$pluginDir = dirname(__FILE__) . '/';
        $path = dirname(__FILE__) . '/' . $name;
        
        //extract($data);
        include($path);

        return ob_get_clean();
    }

}
