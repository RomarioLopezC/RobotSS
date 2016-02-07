<?php

namespace models;

use yii\codeception\TestCase;
use app\models\SocialServiceManager;

class SocialServiceManagerTest extends TestCase
{
    public function testValidateReturnsFalseIfParametersAreNotSet() {
        $SSManager = new SocialServiceManager();
        $this->assertFalse($SSManager->validate(), "New User should not validate");
    }

    public function testValidateReturnsTrueIfParametersAreSet() {
        $configurationParams = [
            'username' => 'miles',
            'email' => 'correo@hotmail.com',
            'password_hash' => \Yii::$app->getSecurity()->generatePasswordHash('admin'),
        ];
        $user = new SocialServiceManager($configurationParams);
        $this->assertTrue($user->validate(), "User with set parameters should validate");
    }


    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
    }

}