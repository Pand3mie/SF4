<?php
namespace App\Tests\Page;

use App\Tests\FunctionalTester;

class Login
{
    // include url of current page
    public static $URL = '/login';
    public static $usernameField = '_username';
    public static $passwordField = '_password';
    public static $loginButton = '_submit';
    public static $rememberMe = '#remember_me';

    /**
     * @var FunctionalTester
     */
    protected $tester;

    public function __construct(FunctionalTester $I)
    {
        $this->tester = $I;
    }

    public function login($name, $password)
    {
        $I = $this->tester;

        $I->amOnPage(self::$URL);
        $I->fillField(self::$usernameField, $name);
        $I->fillField(self::$passwordField, $password);
        $I->click(self::$loginButton);

        return $this;
    }
    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
