<?php


class AboutController Extends Jpl_Controller_Front {
    function index() {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('about');
        
        // Render the action with template
        $this->renderWithTemplate('about/index', 'subpage_base_template');
    }    
}
?>