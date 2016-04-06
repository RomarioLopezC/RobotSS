<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 11/02/2016
 * Time: 10:37 PM
 */
namespace app\modules\socialservicemanager\controllers;

use app\models\Person;
use app\models\ProjectVacancy;
use app\models\Registration;
use app\models\SocialServiceManager;
use app\models\SocialServiceManagerSearch;
use dektrium\user\models\User;
use Yii;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SocialServiceManagerController implements the CRUD actions for SocialServiceManager model.
 */
class SocialServiceManagerController extends Controller
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
            $person->lastname = $model->last_name;
            $person->phone = $model->phone;
            $person->save(false);
            $user = new User();
            $user->username = $model->username;
            $user->password = $model->password;
            $user->email = $model->email;
            $user->person_id = $person->id;
            $user->scenario = 'register';
            if ($user->validate(['username', 'password'])) {
                $user->register();
                $model->user_id = $user->id;
                $model->save(false);
                //assign the role to the user
                $authManager = Yii::$app->getAuthManager();
                $socialServiceMRole = $authManager->getRole('socialServiceManager');
                $authManager->assign($socialServiceMRole, $user->id);
                //set the success message
                Yii::$app->getSession()->setFlash('success', 'Usuario creado con éxito');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
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
        $model = SocialServiceManager::findOne(['user_id' => $id]);

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
        Yii::$app->db->createCommand()->delete('social_service_manager', 'user_id =' . $user_id . '')->execute();
        Yii::$app->db->createCommand()->delete('user', 'id =' . $user_id . '')->execute();
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

    /**
     * @return string
     */
    public function actionViewPreregisteredStudents()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Registration::find()->where(['student_status' => Registration::UNASSIGNED]),
        ]);
        return $this->render('view_preregistered_students', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionAssignStudent($project_id, $student_id)
    {
        if (($model = Registration::find()->where(['project_id' => $project_id, 'student_id' => $student_id])->one()) !== null) {
            if ($model->student_status != Registration::ASSIGNED) {
                //Se registra como asignado
                $model->student_status = Registration::ASSIGNED;
                $model->save();

                //Se resta un vacante del proyecto
                $projectVacancy = ProjectVacancy::find()->where(['project_id' => $model->project->id])->one();
                $projectVacancy->vacancy = $projectVacancy->vacancy - 1;
                $projectVacancy->update();

                //Se envia el correo al estudiante
                Yii::$app->mailer->compose()
                    ->setFrom('from@domain.com')
                    ->setTo($model->student->user->email)
                    ->setSubject('Asignación de alumno al proyecto' . ' ' . $model->project->name)
                    ->setTextBody('Asignación exitosa')
                    ->setHtmlBody('<b>Asignación exitosa</b>')
                    ->send();

                //Se envia el correo al project manager
                Yii::$app->mailer->compose()
                    ->setFrom('from@domain.com')
                    ->setTo($model->project->projectManager->user->email)
                    ->setSubject('Asignación de alumno al proyecto' . ' ' . $model->project->name)
                    ->setTextBody('Asignación exitosa')
                    ->setHtmlBody('<b>Asignación exitosa</b>')
                    ->send();

                Yii::$app->getSession()->setFlash('success', 'Alumno asignado exitosamente.');
                $this->redirect('view-preregistered-students');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'El alumno ya ha sido asignado previamente.');
                $this->redirect('view-preregistered-students');
            }
        } else {
            throw new NotFoundHttpException('El estudiante no ha sido encontrado.');
        }
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionCancelPreregistration($project_id, $student_id)
    {
        if (($model = ($model = Registration::find()->where(['project_id' => $project_id, 'student_id' => $student_id])->one()) !== null)) {
            $model->student_status = Registration::PREREGISTRATION_CANCELLED;
            $model->save();

            //Se envia el correo al estudiante
            Yii::$app->mailer->compose()
                ->setFrom('from@domain.com')
                ->setTo($model->student->user->email)
                ->setSubject('Asignación de alumno al proyecto' . ' ' . $model->project->name)
                ->setTextBody('Su registro al proyecto ha sido rechazado.')
                ->setHtmlBody('<b>Asignación exitosa</b>')
                ->send();

            Yii::$app->getSession()->setFlash('success', 'Alumno eliminado.');
            $this->redirect('view-preregistered-students');
        } else {
            throw new NotFoundHttpException('El estudiante no ha sido encontrado.');
        }
    }
}
