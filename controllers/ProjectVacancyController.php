<?php

namespace app\controllers;

/**
 * Class ProjectVacancyController
 * @package app\controllers
 */
class ProjectVacancyController extends \yii\web\Controller {
    /**
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

}
