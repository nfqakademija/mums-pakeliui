<?php
class LoginCest 
{
    public function loginSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->clickWithLeftButton('#dropdownMenuButton');
        $I->wait(2);
        $I->click('Prisijungti');
        $I->wait(2);
        $I->fillField('Naudotojo vardas', "asilas");
        $I->wait(2);
        $I->fillField('Slaptažodis', "123");
        $I->wait(2);
        $I->clickWithLeftButton('#_submit');
        $I->wait(2);
        $I->see('asilas');
        $I->wait(2);
    }
    
    public function loginWithInvalidPassword(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->clickWithLeftButton('#dropdownMenuButton');
        $I->wait(2);
        $I->click('Prisijungti');
        $I->wait(2);
        $I->fillField('Naudotojo vardas', "asilas");
        $I->wait(2);
        $I->fillField('Slaptažodis', "567");
        $I->wait(2);
        $I->clickWithLeftButton('#_submit');
        $I->wait(2);
        $I->see('Klaidingi duomenys.');
        $I->wait(2);
    }       
}