<div class="pageContainer">
    <?php foreach ($articles as $article) { ?>
        <h2><a href="<?php echo ViewHelper::createLinkUrl('article', 'view'); ?>/<?php echo $article->article_id; ?>"><?php echo $article->title; ?></a></h2>
        <p>By <?php echo $article->author; ?> at <?php echo $article->created_on; ?>.<?php echo $article->created_on_ms; ?></p>    
    <?php } ?>
</div>