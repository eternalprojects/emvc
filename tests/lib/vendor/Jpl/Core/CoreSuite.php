<?php
namespace Test\Jpl\Core;

require_once 'AutoLoaderTest.php';
require_once 'RouterTest.php';
require_once 'RouteTest.php';
require_once 'UriTest.php';
require_once 'ViewTest.php';
require_once 'Config/JsonTest.php';
require_once 'Controller/FrontTest.php';
//require_once 'Controller/PageTest.php';
require_once 'Registry/ApplicationTest.php';
require_once 'View/Helper/UrlTest.php';


/**
 * Static test suite.
 */
class CoreSuite extends \PHPUnit_Framework_TestSuite
{

    /**
     * Constructs the test suite handler.
     */
    public function __construct ()
    {
        $this->setName('CoreSuite');
        $this->addTestSuite('\Test\Jpl\Core\AutoLoaderTest');
        $this->addTestSuite('\Test\Jpl\Core\RouterTest');
        $this->addTestSuite('\Test\Jpl\Core\RouteTest');
        $this->addTestSuite('\Test\Jpl\Core\UriTest');
        $this->addTestSuite('\Test\Jpl\Core\ViewTest');
        $this->addTestSuite('\Test\Jpl\Core\Config\JsonTest');
        //$this->addTestSuite('\Test\Jpl\Core\Controller\PageTest');
        $this->addTestSuite('\Test\Jpl\Core\Controller\FrontTest');
        $this->addTestSuite('\Test\Jpl\Core\Registry\ApplicationTest');
        $this->addTestSuite('\Test\Jpl\Core\View\Helper\UrlTest');
        
    }

    /**
     * Creates the suite.
     */
    public static function suite ()
    {
        return new self();
    }
}

