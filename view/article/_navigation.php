<?php require_once './utility/view_helper.php'; ?>
<div>
    <div><h4>Article</h4></div>
    <ul>
        <li><a href="<?php ViewHelper::createLinkUrl('article', 'index'); ?>">List Articles</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('article', 'add'); ?>">Add Article</a></li>        
    </ul>    
</div>