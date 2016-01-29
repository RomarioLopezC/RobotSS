<?php
namespace models;


use app\models\User;
use app\tests\codeception\unit\fixtures\UserFixture;
use yii\codeception\TestCase;

class UserTest extends TestCase {

    protected function _before() {
    }

    protected function _after() {
    }

    public function testValidateReturnsFalseIfParametersAreNotSet() {
        $user = new User();
        $this->assertFalse($user->validate(), "New User should not validate");
    }

    public function testValidateReturnsTrueIfParametersAreSet() {
        $configurationParams = [
            'username' => 'miles',
            'email' => 'correo@hotmail.com',
            'password_hash' => \Yii::$app->getSecurity()->generatePasswordHash('admin'),
        ];
        $user = new User($configurationParams);
        $this->assertTrue($user->validate(), "User with set parameters should validate");
    }
}