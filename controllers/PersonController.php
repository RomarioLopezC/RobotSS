<?php

namespace app\controllers;

use app\models\ProjectManager;
use app\models\SocialServiceManager;
use app\models\Student;
use app\models\User;
use dektrium\user\helpers\Password;
use dektrium\user\models\SettingsForm;
use Yii;
use app\models\Person;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        $model = $this->findModel($user->person_id);
        $rol = $user->getUserRole();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {

            if (isset($rol)) {
                $rol->load(Yii::$app->request->post());
                $rol->save(false);
            }

            if ($model->save() && $user->save()) {
                Yii::$app->getSession()->setFlash('success', 'Su información se actualizó exitosamente');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ocurrió un error al guardar. Vuelve a intentar');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'rol' => $rol
        ]);

    }

    /**
     * @param $id
     */
    public function actionChangePassword($id)
    {
        $userInfo = Yii::$app->request->post()['settings-form'];
        $user = User::findIdentity($id);
        if (Password::validate($userInfo['current_password'], $user->password_hash)) {
            if ($user->resetPassword($userInfo['new_password'])) {
                Yii::$app->getSession()->setFlash('success', 'Contraseña cambiada con éxito');
            }
            if ($user->username != $userInfo['username']) {
                $user->username = $userInfo['username'];
                $user->save();
                Yii::$app->getSession()->setFlash('success', 'Nombre de usuario cambiado con éxito');
            }
        } else {
            Yii::$app->getSession()->setFlash('danger',
                'La contraseña actual no corresponde, valide e intente nuevamente');
        }
        $this->redirect(['person/update', 'id' => Yii::$app->user->id]);
    }


    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
