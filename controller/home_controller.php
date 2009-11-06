<?php
require_once './lib/simplemvcwf/view_data.php';
require_once './lib/simplemvcwf/controller_base.php';

class HomeController Extends ControllerBase {
    function index() {
        // Render the action with template
        $this->renderWithTemplate('home/index', 'frontpage_base_template');
    }    
}
?>