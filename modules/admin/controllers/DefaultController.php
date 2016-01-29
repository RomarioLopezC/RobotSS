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

    public function actionNewSocialServiceManager()
    {
        $socialServiceManager = new SocialServiceManager();
        $user = new User();

        return $this->render('SocialServiceManager/create', [
            'socialServiceManager' => $socialServiceManager,
            'user' => $user
        ]);
    }

    public function actionCreateSocialServiceManager()
    {
        $socialServiceManager = new SocialServiceManager();
        $user = new User();

        $user->username = Yii::$app->request->post()['User']['username'];
        $user->password = Yii::$app->request->post()['User']['password'];
        $user->email = Yii::$app->request->post()['User']['email'];
        $user->scenario = 'connect';

        if($user->register()){
            $socialServiceManager->load(Yii::$app->request->post());
            $socialServiceManager->user_id = $user->id;
            $socialServiceManager->save(false);
            return $this->redirect(['list-social-service-managers']);
        }else{
            return $this->render('index');
        }
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
