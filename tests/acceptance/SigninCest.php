<?php 

class SigninCest
{
    public function SignInWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->sendAjaxPostRequest('/process.php', array('userEmail' => 'smithhan@gmail.com', 'password' => 'aaa', 'signin' => true));
        $I->amOnPage('/');
        $I->see('Welcome Smith Han');
    }
}
