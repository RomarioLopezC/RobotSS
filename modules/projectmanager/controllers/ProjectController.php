<?php

namespace app\modules\projectmanager\controllers;

use app\models\Degree;
use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentProfile;
use yii\helpers\ArrayHelper;
use app\models\ProjectVacancy;

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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $vacancyvalue = $_POST['Project']['vacancy'];
            $newVacancy = new ProjectVacancy();
            $newVacancy->project_id = $model->id;
            $newVacancy->vacancy = $vacancyvalue;
            $newVacancy->save();

            $degreesList = $_POST['Project']['degrees'];
            foreach ($degreesList as $value) {
                $newProfile = new StudentProfile();
                $newProfile->project_id = $model->id;
                $newProfile->degree_id = $value;
                $newProfile->save();
            }
            Yii::$app->getSession()->setFlash('success', 'Proyecto creado con éxito');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $degreeids = StudentProfile::find()
            ->where("project_id=" . $model->id)
            ->all();
        $cupovalor = ProjectVacancy::find()
            ->where("project_id=" . $model->id)
            ->all();

        $ids = ArrayHelper::getColumn($degreeids, 'degree_id');
        $cupo = ArrayHelper::getColumn($cupovalor, 'vacancy')[0];
        $model->degrees = $ids;
        $model->vacancy = $cupo;

        //$degrees1 = Degree::find()->all();
        //$model->degrees = \yii\helpers\ArrayHelper::getColumn(
        //    $model->hasMany(StudentProfile::className(), ['project_id' => 'id'])->asArray()->all(),
        //    'project_id'
        //);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            StudentProfile::deleteAll('project_id=' . $model->id);
            ProjectVacancy::deleteAll('project_id=' . $model->id);
            $vacancyvalue = $_POST['Project']['vacancy'];
            $newVacancy = new ProjectVacancy();
            $newVacancy->project_id = $model->id;
            $newVacancy->vacancy = $vacancyvalue;
            $newVacancy->save();

            $degreesList = $_POST['Project']['degrees'];


            foreach ($degreesList as $value) {
                $newProfile = new StudentProfile();
                $newProfile->project_id = $model->id;
                $newProfile->degree_id = $value;
                $newProfile->save();
            }
            Yii::$app->getSession()->setFlash('success', 'Proyecto actualizado con éxito');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
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
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
