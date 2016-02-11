<?php

namespace app\modules\admin\controllers;

use dektrium\user\controllers\RegistrationController;
use dektrium\user\models\User;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\SocialServiceManager;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionListSocialServiceManagers()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SocialServiceManager::find(),
        ]);

        return $this->render('SocialServiceManager/index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
