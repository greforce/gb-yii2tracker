<?php
namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class FirstCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    /**
    * @dataProvider pageProvider
    */
    public function checkAllPages(FunctionalTester $I, \Codeception\Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['title'], 'h1');
    }

    /**
     * @return array
     */
    protected function pageProvider() // alternatively, if you want the function to be public, be sure to prefix it with `_`
    {
        return [
            ['url'=>"/site", 'title'=>"Congratulations!"],
            ['url'=>"/site/about", 'title'=>"About"],
            ['url'=>"/site/contact", 'title'=>"Contact"],
            ['url'=>"/site/signup", 'title'=>"Signup"],
            ['url'=>"/site/login", 'title'=>"Login"]
        ];
    }
}
