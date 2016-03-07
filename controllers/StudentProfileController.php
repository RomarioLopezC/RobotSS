<?php

namespace app\controllers;
/**
 * Class StudentProfileController
 * @package app\controllers
 */
class StudentProfileController extends \yii\web\Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

}
