<?php

namespace app\controllers;

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

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
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
        $model = new ProjectManagerForm();

        if ($model->load(Yii::$app->request->post())) {

            $attr = Yii::$app->request->post('ProjectManagerForm');

            $userAttr = [
                'username' => $attr['name'],
                'email' => $attr['email'],
                'password_hash' => Yii::$app->getSecurity()->generatePasswordHash($attr['password']),
            ];

            $user = new User($userAttr);

            $projectManagerAttr = [
                'last_name' => $attr['lastName'],
                'organization' => $attr['organization'],
            ];

            $projectManager = new ProjectManager($projectManagerAttr);
            $projectManager->setUser($user);

            if($projectManager->validate()){
                $projectManager->save();
                Yii::$app->session->setFlash('success', 'Se envío un correo de confirmación. Por favor verifique su correo electrónico');
            }else{
                Yii::$app->session->setFlash('error', 'Ocurrió un error al guardar. Vuelve a intentar');
                return $this->refresh();
            }
        }

        return $this->render('project-manager-request', [
            'model' => $model,
        ]);
    }
}
