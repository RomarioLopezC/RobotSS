<?php

namespace app\controllers;

/**
 * Class RegistrationController
 * @package app\controllers
 */
class RegistrationController extends \yii\web\Controller {
    /**
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

}
