<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Registration;
use app\models\User;
use app\models\Student;
use app\models\ProjectVacancy;
use app\models\StudentProfile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller {
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPreregister($id){
        $model = $this->findModel($id);
        //$user_id=User::findOne(Yii::$app->user->id)->id;
        $user = User::find()
            ->where("id=" .Yii::$app->user->id)
            ->one();
        $user_id=$user->id;
        $student = Student::find()
            ->where("user_id=" .$user_id)
            ->one();
        $student_id=$student->id;

        $vacancy = ProjectVacancy::find()
            ->where("project_id=" .$id)
            ->one();
        //$vacancyValue=ArrayHelper::getColumn($vacancy, 'vacancy')[0];
        $vacancyValue=$vacancy->vacancy;

        if($existe=StudentProfile::find()->where(['project_id' => $id, 'degree_id' => $student->degree_id])->one()) {


            if ($vacancyValue > 0) {

                $newRegistration = new Registration();
                $newRegistration->project_id = $id;
                $newRegistration->student_id = $student_id;
                $newRegistration->student_status = "preregistered";
                $newRegistration->save();

                //$vacancy->vacancy=$vacancy->vacancy-1;
                Yii::$app->db->createCommand()->update('project_vacancy', ['vacancy' =>$vacancy->vacancy-1],'project_id='.$id)->execute();
                if(Registration::find()->where(['student_id' => $student_id])->one()) {
                    Yii::$app->getSession()->setFlash('danger', 'Ya te has pre-registrado a un proyecto');
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->getSession()->setFlash('success', 'Te has pre-registrado al proyecto');
                    return $this->redirect(['view', 'id' => $model->id]);
                }


            } else {
                Yii::$app->getSession()->setFlash('danger', 'No hay cupo para este proyecto. Escoge otro.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }else{
            Yii::$app->getSession()->setFlash('danger', 'No cuentas con el perfil solicitado');
            return $this->redirect(['view', 'id' => $model->id]);
        }




    }
}
