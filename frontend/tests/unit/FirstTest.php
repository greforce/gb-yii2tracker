<?php
namespace frontend\tests;

use common\fixtures\UserFixture as UserFixture;
use common\models\User;
use common\models\Project;
use frontend\models\ContactForm;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testNewTask()
    {
        $user = $this->tester->grabFixture('user', 1);
        $project = new Project([
            'title' => 'Test project',
            'description' => 'Test description',
            'created_by' => $user->id,
            'created_at' => time(),
        ]);

        expect($project->created_by)->equals($user->id);
        $this->assertTrue($project->title === 'Test project');
        $this->assertEquals($project->description, 'Test description');
        $this->assertLessThan($project->created_at, time() - 1);
        $this->assertLessThanOrEqual($project->created_at, time());

        $contactForm = new ContactForm();

        $contactForm->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];

        $this->assertAttributeEquals('Tester', 'name', $contactForm);
        $this->assertArrayHasKey('email', $contactForm);
        
        $this->assertArrayHasKey('nickname', $contactForm);
    }
}
