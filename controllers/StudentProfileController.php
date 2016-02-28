<?php

namespace app\controllers;

class StudentProfileController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }

}
