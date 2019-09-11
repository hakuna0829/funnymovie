<?php
class FirstCest 
{
    public function homePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Registeration');  
    }
}