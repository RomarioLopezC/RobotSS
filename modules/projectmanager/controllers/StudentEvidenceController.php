<?php

namespace app\modules\projectmanager\controllers;

use Yii;
use app\models\StudentEvidence;
use app\models\StudentEvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $dataProviderNews = $searchModel->searchNewsByProjectManager(Yii::$app->request->queryParams);
        $dataProviderPending = $searchModel->searchPendingByProjectManager(Yii::$app->request->queryParams);
        $dataProviderAccepted = $searchModel->searchAcceptedByProjectManager(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProviderNews' => $dataProviderNews,
            'dataProviderPending' => $dataProviderPending,
            'dataProviderAccepted' => $dataProviderAccepted,
        ]);
    }

    /**
     * Displays a single StudentEvidence model.
     * @param integer $task_id
     * @param integer $project_id
     * @param integer $evidence_id
     * @param integer $student_id
     * @return mixed
     */
    public function actionView($task_id, $project_id, $evidence_id, $student_id) {
        return $this->render('view', [
            'model' => $this->findModel($task_id, $project_id, $evidence_id, $student_id),
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
            return $this->redirect(['view', 'task_id' => $model->task_id, 'project_id' => $model->project_id, 'evidence_id' => $model->evidence_id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentEvidence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $task_id
     * @param integer $project_id
     * @param integer $evidence_id
     * @param integer $student_id
     * @return mixed
     */
    public function actionUpdate($task_id, $project_id, $evidence_id, $student_id) {
        $model = $this->findModel($task_id, $project_id, $evidence_id, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'task_id' => $model->task_id, 'project_id' => $model->project_id, 'evidence_id' => $model->evidence_id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentEvidence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $task_id
     * @param integer $project_id
     * @param integer $evidence_id
     * @param integer $student_id
     * @return mixed
     */
    public function actionDelete($task_id, $project_id, $evidence_id, $student_id) {
        $this->findModel($task_id, $project_id, $evidence_id, $student_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentEvidence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $task_id
     * @param integer $project_id
     * @param integer $evidence_id
     * @param integer $student_id
     * @return StudentEvidence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($task_id, $project_id, $evidence_id, $student_id) {
        if (($model = StudentEvidence::findOne(['task_id' => $task_id, 'project_id' => $project_id, 'evidence_id' => $evidence_id, 'student_id' => $student_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
