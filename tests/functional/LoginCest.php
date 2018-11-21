<?php
namespace App\Tests;

use App\Tests\FunctionalTester;

class LoginCest
{
    public function tryLogin(FunctionalTester $I, \App\Tests\Page\Login $loginpage)
    {
        $loginPage = new Login($I);
        $loginPage->login('mana', 'mana');
        $I->amOnPage('/');
        
    }

    //test de connexion avec un login désactivé
    public function inactiveLogin(FunctionalTester $I)
    {
        $I->wantTo('Login with desactivate user');
        $I->amOnPage('/login');
        $I->fillField('_username', 'nicolas');
        $I->fillField('_password', 'nicolas');
        $I->click('_submit');
        $I->see('Le compte est désactivé.');
    }

    //test de déconnexion de l'app
    public function ClickLogout(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('_username', 'mana');
        $I->fillField('_password', 'mana');
        $I->click('_submit');
        $I->click('power_settings_new');
        $I->amOnPage('/login');

    }


}
