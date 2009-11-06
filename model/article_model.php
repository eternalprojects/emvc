<?php
require_once './lib/simplemvcwf/model_base.php';
require_once './utility/guid_utility.php';

// Encapsulates all Article database table access.
//   This method of encapsulation uses the singleton
//   design pattern.
class ArticleModel extends ModelBase {
    private static $articleModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of ArticleDbAccess being used
    //   at any one time (eg. singleton)
    static function create() {
        if (NULL == self::$articleModel) {
           self::$articleModel = new ArticleModel();
        }
        return self::$articleModel;
    }
    
    // Retrieves an article row by its article_id    
    public function selectArticleByArticleId($articleId) {
        $sql = "SELECT *"
                . "FROM articles "
                . "WHERE article_id = '" . $articleId. "' "
                . "LIMIT 1;";
        
        return parent::queryFirst($sql);
    }
    
    // Retrieves all articles
    public function selectArticles() {
        $sql = "SELECT *"
                . "FROM articles;";
        
        return parent::query($sql);
    }
    
    // Adds an article row into the article table and
    //   returns the article_id Guid
    public function insertArticle($author, $title, $body, $createdOn, $createdOnMs) {
        $articleId = GuidUtility::newGuid();
        $sql = "INSERT INTO articles "
                . "("
                . "article_id, "
                . "author, "
                . "title, "
                . "body, "
                . "created_on, "
                . "created_on_ms"
                . ") VALUES ("
                . "'" . $articleId . "', "
                . "'" . $author . "', "
                . "'" . $title . "', "
                . "'" . $body . "', "
                . "'" . $createdOn . "', "
                . "'" . $createdOnMs . "'"
                . ");";
        
        parent::execute($sql);
        
        return $articleId;
    }
}
?>