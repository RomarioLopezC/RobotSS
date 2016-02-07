<?php

namespace app\modules\admin\controllers;

use app\models\Person;
use dektrium\user\models\User;
use Yii;
use app\models\SocialServiceManager;
use app\models\SocialServiceManagerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Alert;

/**
 * SocialServiceManagerController implements the CRUD actions for SocialServiceManager model.
 */
class SocialServiceManagerController extends Controller
{
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
     * Lists all SocialServiceManager models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SocialServiceManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SocialServiceManager model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SocialServiceManager model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SocialServiceManager();

        if ($model->load(Yii::$app->request->post())) {
            $person = new Person();
            $person->name = $model->name;
            $person->lastname = $model->lastName;
            $person->phone = $model->phone;
            $person->save(false);
            $user = new User();
            $user->username = $model->username;
            $user->password = $model->password;
            $user->email = $model->email;
            $user->person_id = $person->id;
            $user->scenario='register';
            if ($user->validate(['username', 'password'])) {
                $user->register();
                $model->user_id = $user->id;
                $model->save(false);
                //assign the role to the user
                $authManager = Yii::$app->getAuthManager();
                $socialServiceMRole = $authManager->getRole('socialServiceManager');
                $authManager->assign($socialServiceMRole,$user->id);
                //set the success message
                Yii::$app->getSession()->setFlash('success','Usuario creado con éxito');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $model->addErrors($user->errors);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing SocialServiceManager model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SocialServiceManager model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($user_id)
    {
        //$this->findModel($user_id)->delete();
        Yii::$app->db->createCommand()->delete('social_service_manager', 'user_id ='.$user_id.'')->execute();
        Yii::$app->db->createCommand()->delete('user', 'id ='.$user_id.'')->execute();
        echo Alert::widget([

            'body' => 'El usuario se eliminó exitosamente!'
        ]);


        return $this->redirect(['index']);
    }

    /**
     * Finds the SocialServiceManager model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SocialServiceManager the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SocialServiceManager::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
