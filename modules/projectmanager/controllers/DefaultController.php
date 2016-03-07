<?php

namespace app\modules\projectmanager\controllers;

use yii\web\Controller;

class DefaultController extends Controller {
    /**
     * @return string
     */
    public function actionIndex () {
        return $this->render ('index');
    }
}
