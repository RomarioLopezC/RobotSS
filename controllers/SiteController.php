<?php

namespace app\controllers;

use app\models\Person;
use app\models\ProjectManager;
use app\models\ProjectManagerForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionProjectManagerRequest() {
        $projectManager = new ProjectManager();
        $user = new User();
        $person = new Person();

        if (Yii::$app->request->post()) {
            $params = Yii::$app->request->post();

            $person->load($params);
            $user->load($params);
            $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($params['User']['password_hash']);
            $projectManager->load($params);


            if($person->validate() && $user->validate() && $projectManager->validate()){

                $person->save(false);
                $user->person_id = $person->id;
                $user->register();
                $projectManager->user_id = $user->id;
                $projectManager->save();

                Yii::$app->session->setFlash('success', 'Se envío un correo de confirmación. Por favor verifique su correo electrónico');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('danger', 'Ocurrió un error al guardar. Vuelve a intentar');
                return $this->refresh();
            }

        }else{
            return $this->render('project-manager-request', [
                'projectManager' => $projectManager,
                'user' => $user,
                'person' => $person,
            ]);
        }

    }

}
