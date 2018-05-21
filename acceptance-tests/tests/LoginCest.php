<?php
class LoginCest 
{
    /*
    public function registration(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->clickWithLeftButton('#dropdownMenuButton');
        $I->wait(2);
        $I->click('Registruotis');
        $I->wait(2);
        $I->fillField('El. paštas', "vasara@takas.lt");
        $I->wait(2);
        $I->fillField('Naudotojo vardas', "vasara");
        $I->wait(2);
        $I->fillField('Slaptažodis', "123");
        $I->wait(2);
        $I->fillField('Pakartoti slaptažodį', "123");
        $I->wait(2);
        $I->clickWithLeftButton('#registrationButton');
        $I->wait(2);
        $I->see('vasara');
        $I->wait(2);
        $I->clickWithLeftButton('#dropdownMenuButton');
        $I->wait(2);
        $I->click('Atsijungti');
        $I->wait(2);
        $I->dontSee('vasara');
        $I->wait(2);
    }
    /**
     * @depends registration
     */
    /*
    public function loginSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->clickWithLeftButton('#dropdownMenuButton');
        $I->wait(2);
        $I->click('Prisijungti');
        $I->wait(2);
        $I->fillField('Naudotojo vardas', "vasara");
        $I->wait(2);
        $I->fillField('Slaptažodis', "123");
        $I->wait(2);
        $I->clickWithLeftButton('#_submit');
        $I->wait(2);
        $I->see('vasara');
        $I->wait(2);
    }

    /**
     * @depends registration
     */
    /*
    public function loginWithInvalidPassword(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->clickWithLeftButton('#dropdownMenuButton');
        $I->wait(2);
        $I->click('Prisijungti');
        $I->wait(2);
        $I->fillField('Naudotojo vardas', "vasara");
        $I->wait(2);
        $I->fillField('Slaptažodis', "567");
        $I->wait(2);
        $I->clickWithLeftButton('#_submit');
        $I->wait(2);
        $I->see('Klaidingi duomenys.');
        $I->wait(2);
    }
    */
}