<?php

namespace Test\Jpl\View\Helper;
use \Jpl\View\Helper\Url;



/**
 * Url test case.
 */
class UrlTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Url
     */
    private $Url;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        $this->Url = new Url();
        \Jpl\Registry\Application::set('baseUrl', 'http://jpl');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Url = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        
    }

    /**
     * Tests Url::createLinkUrl()
     */
    public function testCreateLinkUrl ()
    {
        
        $this->assertEquals('http://jpl/test/test', Url::createLinkUrl('test', 'test'));
    }

    /**
     * Tests Url::createStaticUrl()
     */
    public function testCreateStaticUrl ()
    {
        
        $this->assertEquals('http://jpl/static/something/something/darkside', Url::createStaticUrl('something/something/darkside'));
        
    }
}

