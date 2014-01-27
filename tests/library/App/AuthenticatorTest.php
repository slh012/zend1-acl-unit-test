<?php

/**
 * Description of AuthenticatorTest
 *
 * @author Sean
 */
class App_AuthenticatorTest extends ControllerTestCase
{
    /**
     *
     * @var App_Auth_Authenticator
     */
    protected $auth;
    protected $regularUser = 'john';
    protected $regularPass = 'pa$$';
    
    public function setUp()
    {
        parent::setUp();
        $this->auth = new App_Auth_Authenticator();
        
    }
    public function testCanDetectFailedAdminLogin()
    {
        $this->assertFalse($this->auth->getCredentials('admin', 'someBadPass'));
        $this->assertEquals(App_Auth_Authenticator::ERR_BAD_PASSWORD,
                            $this->auth->getErrorMessage());
    }
    
    public function testCanDetectValidAdminLogin()
    {        
        $this->assertTrue($this->auth->getCredentials('admin', 'qwerty')  instanceof stdClass  );
    }
    
    public function testCanDetectInvalidLogin()    
    {
        $baduser = 'nouser';
        $this->assertFalse($this->auth->getCredentials($baduser, 'someBadPass'));
        $this->assertEquals(App_Auth_Authenticator::ERR_NOT_FOUND,
                            $this->auth->getErrorMessage());
    }
    
    public function testCanDetectFailedLogin()
    {
        $this->assertFalse($this->auth->getCredentials($this->regularUser, 'someBadPass'));
        $this->assertEquals(App_Auth_Authenticator::ERR_BAD_PASSWORD,
                            $this->auth->getErrorMessage());
    }
    
    public function testCanDetectValidUserLogin()
    {
        $this->assertTrue($this->auth->getCredentials($this->regularUser, $this->regularPass)  instanceof stdClass  );
        
    }
}
