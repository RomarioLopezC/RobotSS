<?php

namespace app\controllers;

use app\models\Notification;
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

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionProjectManagerRequest() {
        $projectManager = new ProjectManager();
        $user = new User();
        $person = new Person();

        if (Yii::$app->request->post()) {
            $params = Yii::$app->request->post();

            $person->load($params);
            $user->load($params);
            $projectManager->load($params);

            if ($person->validate() && $user->validate() && $projectManager->validate()) {
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($params['User']['password_hash']);
                $person->save(false);
                $user->person_id = $person->id;
                $user->register();
                $projectManager->user_id = $user->id;
                $projectManager->save();

                Yii::$app->session->setFlash('success',
                    'Se envío un correo de confirmación. Por favor verifique su correo electrónico');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('danger', 'Ocurrió un error al guardar. Vuelve a intentar');
            }

        }
        return $this->render('project-manager-request', [
            'projectManager' => $projectManager,
            'user' => $user,
            'person' => $person,
        ]);
    }

    /**
     * @param $id
     */
    public function actionViewNotification($id) {
        $notification = Notification::findOne([$id]);
        $url = $notification->url;
        $notification->delete();
        $this->redirect($url);
    }
}


