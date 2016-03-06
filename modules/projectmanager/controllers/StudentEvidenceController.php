<?php

namespace app\modules\projectmanager\controllers;

use app\models\Person;
use app\models\Registration;
use app\models\Task;
use app\models\StudentEvidence;
use app\models\StudentEvidenceSearch;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * StudentEvidenceController implements the CRUD actions for StudentEvidence model.
 */
class StudentEvidenceController extends Controller {
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
     * Lists all StudentEvidence models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StudentEvidenceSearch();
        $dataProviderNews = $searchModel->search(Yii::$app->request->queryParams,
            StudentEvidence::$NEW, false);
        $dataProviderPending = $searchModel->search(Yii::$app->request->queryParams,
            StudentEvidence::$PENDING, false);
        $dataProviderAccepted = $searchModel->search(Yii::$app->request->queryParams,
            StudentEvidence::$ACCEPTED, false);

        if ($userId = $dataProviderNews->getModels()) {
            $userId = $dataProviderNews->getModels()[0]['student']['user_id'];

            $user = User::findOne($userId);
            $person = Person::findOne($user->person_id);

            $dataProviderNews->getModels()[0]['student']['user_id'] = $person->name;
            $dataProviderPending->getModels()[0]['student']['user_id'] = $person->name;
            $dataProviderAccepted->getModels()[0]['student']['user_id'] = $person->name;
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProviderNews' => $dataProviderNews,
            'dataProviderPending' => $dataProviderPending,
            'dataProviderAccepted' => $dataProviderAccepted,
        ]);
    }

    public function actionSelectProject() {
        $model = new Task();
        $project = $_POST['list'];

        if (Registration::find()->where("projectId=" . $project)->all()) {
            return $this->render('create', [
                'model' => $model,
                'projectId' => $project,

            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'No hay estudiantes en el proyecto seleccionado ');
            return $this->redirect(['index']);
        }
    }

    /**
     * Displays a single StudentEvidence model.
     * @param integer $taskId
     * @param integer $projectId
     * @param integer $evidenceId
     * @param integer $studentId
     * @return mixed
     */
    public function actionView($taskId, $projectId, $evidenceId, $studentId) {
        return $this->render('view', [
            'model' => $this->findModel($taskId, $projectId, $evidenceId, $studentId),
        ]);
    }

    /**
     * Creates a new StudentEvidence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StudentEvidence();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'taskId' => $model->task_id, 'projectId' => $model->project_id,
                'evidenceId' => $model->evidence_id, 'studentId' => $model->student_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentEvidence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $taskId
     * @param integer $projectId
     * @param integer $evidenceId
     * @param integer $studentId
     * @return mixed
     */
    public function actionUpdate($taskId, $projectId, $evidenceId, $studentId) {
        $model = $this->findModel($taskId, $projectId, $evidenceId, $studentId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'taskId' => $model->task_id, 'projectId' => $model->project_id,
                'evidenceId' => $model->evidence_id, 'studentId' => $model->student_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentEvidence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $taskId
     * @param integer $projectId
     * @param integer $evidenceId
     * @param integer $studentId
     * @return mixed
     */
    public function actionDelete($taskId, $projectId, $evidenceId, $studentId) {
        $this->findModel($taskId, $projectId, $evidenceId, $studentId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentEvidence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $taskId
     * @param integer $projectId
     * @param integer $evidenceId
     * @param integer $studentId
     * @return StudentEvidence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($taskId, $projectId, $evidenceId, $studentId) {
        if (($model = StudentEvidence::findOne(['taskId' => $taskId, 'projectId' => $projectId,
                'evidenceId' => $evidenceId, 'studentId' => $studentId])) !== null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
