<?php
namespace App\Tests;


use App\Tests\AcceptanceTester;

class LoginCest
{

    // tests
    public function tryLogin(AcceptanceTester $I, \App\Tests\Page\Login $loginpage)
    {
        $loginPage = new LoginPage($I);
        $loginPage->login('mana', 'mana');
        $I->amOnPage('/');
        
    }
}
