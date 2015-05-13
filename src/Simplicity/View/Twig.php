<?php
namespace Simplicity\View;

class Twig extends Base
{
    public function render($filename)
    {
        $template = $this->engine->loadTemplate($filename);
        echo $template->render($this->obj);
    }
}
