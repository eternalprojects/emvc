<?php
require_once './lib/simplemvcwf/view_data.php';
require_once './lib/simplemvcwf/controller_base.php';
require_once './model/article_model.php';
require_once './utility/date_time_utility.php';

class ArticleController Extends ControllerBase {
    function index() {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('article');
        
        // Get all articles and store them in the 'articles' view data structure
        $this->viewData['articles'] = ArticleModel::create()->selectArticles();
        
        // Render the action with template
        $this->renderWithTemplate('article/index', 'subpage_base_template');
    }
    
    function view($actionValues) {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('article');
        
        // Get all articles and store them in the 'articles' view data structure
        $this->viewData['article'] = ArticleModel::create()->selectArticleByArticleId($actionValues[0]);
        
        // Render the action with template
        $this->renderWithTemplate('article/view', 'subpage_base_template');
    }
    
    function add() {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('article');
        
        // Render the action with template
        $this->renderWithTemplate('article/add', 'subpage_base_template');
    }
    
    function addsubmit() {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('article');

        // Get the current precise time, including milliseconds
        list($s, $ms) = DateTimeUtility::getPreciseTime();
        // Use the add action's post form variables and the current precise time to insert an article.
        //   We should validate all post variables before inserting them to avoid a
        //   SQL Injection attack and ensure that we've working with clean data. For
        //   the purposes of this demo, we're just going to use the post variables
        //   directly.
        ArticleModel::create()->insertArticle($_POST['author'], $_POST['title'], $_POST['body'], date("Y-m-d H:i:s", $s), $ms);

        // Normally we might render the addsubmit action and indicate success or failure.
        //   For now, we're just going to redirect to the home/index action.
        header('Location: ../home/index');
        
        // See previous comment.
        //$this->renderWithTemplate('article/addsubmit', 'subpage_base_template');
    }
}
?>