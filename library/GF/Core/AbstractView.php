<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 09.07.17
 * Time: 23:08
 */

namespace GF\Core;

class AbstractView
{
    public $layout;
    public $view;

    public function __construct($route)
    {
        $this->layout = ROOT . DIRECTORY_SEPARATOR . LAYOUT_MAIN;
        $this->view = ROOT .
            DIRECTORY_SEPARATOR . APP .
            DIRECTORY_SEPARATOR . MODULES .
            DIRECTORY_SEPARATOR . ucfirst($route['module']) .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . strtolower($route['controller']) .
            DIRECTORY_SEPARATOR . $route['action'] . '.php';
    }

    public function show($layoutOnly = false)
    {
        ob_start();
        $viewContent   = (file_exists($this->view))   ? file_get_contents($this->view)   : '<p>View file not found  </p>';
        $layoutContent = (file_exists($this->layout)) ? file_get_contents($this->layout) : '<p>Layout file not found</p>';
        $mixContent = preg_replace('/'.CONTENT_PLACEHOLDER.'/', $viewContent, $layoutContent);

        $resultContent = ($layoutOnly) ? str_replace(CONTENT_PLACEHOLDER, '', $layoutContent ): $mixContent;
        eval('?>' . $resultContent . '<?php ');
        $result = ob_get_contents();
        ob_end_clean();
        echo $result;
    }
}