<?php

namespace app\modules\projectmanager\controllers;

use app\models\Project;
use app\models\ProjectManager;
use app\models\ProjectSearch;
use app\models\ProjectVacancy;
use app\models\Registration;
use app\models\Student;
use app\models\StudentProfile;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller {
    /**
     * @return array
     */
    public function behaviors () {
        return [
            'verbs' => [
                'class' => VerbFilter::className (),
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
    public function actionIndex () {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search (Yii::$app->request->queryParams);

        return $this->render ('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView ($id) {
        return $this->render ('view', [
            'model' => $this->findModel ($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate () {
        $model = new Project();

        $user_id = User::find ()
            ->where ("id=" . Yii::$app->user->id)
            ->one ()->id;

        $manager_id = ProjectManager::find ()
            ->where ("user_id=" . $user_id)
            ->one ()->id;
        $model->manager_id = $manager_id;

        if ($model->load (Yii::$app->request->post ()) && $model->save ()) {

            $vacancyValue = $_POST['Project']['vacancy'];
            $newVacancy = new ProjectVacancy();
            $newVacancy->project_id = $model->id;
            $newVacancy->vacancy = $vacancyValue;
            $newVacancy->save ();

            $degreesList = $_POST['Project']['degrees1'];
            foreach ($degreesList as $value) {
                $this->createStudentProfile ($model->id, $value);
            }
            Yii::$app->getSession ()->setFlash ('success', 'El proyecto se ha creado exitosamente');
            return $this->redirect (['view', 'id' => $model->id]);
        } else {
            return $this->render ('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a student profile for the project
     * @param $modelId
     * @param $value
     */
    private function createStudentProfile ($modelId, $value) {
        $newProfile = new StudentProfile();
        $newProfile->project_id = $modelId;
        $newProfile->degree_id = $value;
        $newProfile->save ();
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate ($id) {
        $model = $this->findModel ($id);
        $user_id = User::find ()
            ->where ("id=" . Yii::$app->user->id)
            ->one ()->id;

        $manager_id = ProjectManager::find ()
            ->where ("user_id=" . $user_id)
            ->one ()->id;
        $model->manager_id = $manager_id;

        $degreeIds = StudentProfile::find ()
            ->where ("project_id=" . $model->id)
            ->all ();
        $cupoValor = ProjectVacancy::find ()
            ->where ("project_id=" . $model->id)
            ->all ();

        $ids = ArrayHelper::getColumn ($degreeIds, 'degree_id');
        $cupo = ArrayHelper::getColumn ($cupoValor, 'vacancy')[0];
        $model->degrees1 = $ids;
        $model->vacancy = $cupo;

        if ($model->load (Yii::$app->request->post ()) && $model->save ()) {
            StudentProfile::deleteAll ('project_id=' . $model->id);
            ProjectVacancy::deleteAll ('project_id=' . $model->id);
            $vacancyValue = $_POST['Project']['vacancy'];
            $newVacancy = new ProjectVacancy();
            $newVacancy->project_id = $model->id;
            $newVacancy->vacancy = $vacancyValue;
            $newVacancy->save ();

            $degreesList = $_POST['Project']['degrees1'];

            foreach ($degreesList as $value) {
                $this->createStudentProfile ($model->id, $value);
            }
            Yii::$app->getSession ()->setFlash ('success', 'Los cambios se han guardado exitosamente');
            return $this->redirect (['view', 'id' => $model->id]);
        } else {
            return $this->render ('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete ($id) {
        $this->findModel ($id)->delete ();
        Registration::deleteAll (['project_id' => $id]);
        ProjectVacancy::deleteAll (['project_id' => $id]);
        Yii::$app->getSession ()->setFlash ('success', 'El proyecto se ha eliminado exitosamente.');
        return $this->redirect (['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ($id) {
        if (($model = Project::findOne ($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Preregisters student to selected project
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionPreregister ($id) {
        $model = $this->findModel ($id);
        $user = User::find ()
            ->where ("id=" . Yii::$app->user->id)
            ->one ();
        $user_id = $user->id;
        $student = Student::find ()
            ->where ("user_id=" . $user_id)
            ->one ();
        $student_id = $student->id;

        $vacancy = ProjectVacancy::find ()
            ->where ("project_id=" . $id)
            ->one ();

        $vacancyValue = $vacancy->vacancy;

        if ($existe = StudentProfile::find ()->where (['project_id' => $id, 'degree_id' => $student->degree_id])->one ()) {


            if ($vacancyValue > 0) {

                $newRegistration = new Registration();
                $newRegistration->project_id = $id;
                $newRegistration->student_id = $student_id;
                $newRegistration->student_status = "preregistered";
                $newRegistration->save ();


                Yii::$app->db->createCommand ()->update ('project_vacancy', ['vacancy' => $vacancy->vacancy - 1],
                    'project_id=' . $id)->execute ();


                Yii::$app->getSession ()->setFlash ('success', 'Te has pre-registrado al proyecto');
                return $this->redirect (['view', 'id' => $model->id]);
            } else {
                Yii::$app->getSession ()->setFlash ('danger', 'No hay cupo para este proyecto. Escoge otro.');
                return $this->redirect (['view', 'id' => $model->id]);
            }
        } else {
            Yii::$app->getSession ()->setFlash ('danger', 'No cuentas con el perfil solicitado');
            return $this->redirect (['view', 'id' => $model->id]);
        }


    }
}
