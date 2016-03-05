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
class PersonController extends Controller {
    public function behaviors() {
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
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Person::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
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
    public function actionUpdate($id) {
        $user = User::findOne($id);
        $model = $this->findModel($user->person_id);
        $rol = null;

        if (Yii::$app->user->can('projectManager')) {
            $rol = ProjectManager::findOne(['user_id' => $user->id]);
        } else if (Yii::$app->user->can('socialServiceManager')) {
            $rol = SocialServiceManager::findOne(['user_id' => $user->id]);
        } else if (Yii::$app->user->can('student')) {
            $rol = Student::findOne(['user_id' => $user->id]);
        }

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

    public function actionChangePassword($id) {
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
            Yii::$app->getSession()->setFlash('danger', 'La contraseña actual no corresponde, valide e intente nuevamente');
        }
        $this->redirect(['person/update', 'id' => Yii::$app->user->id]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
