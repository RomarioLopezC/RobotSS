<?php

namespace app\modules\projectmanager\controllers;

use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentEvidence;
use app\models\Registration;
use app\models\Evidence;


/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    public function behaviors ()
    {
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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex ()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search (Yii::$app->request->queryParams);

        return $this->render ('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);






    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView ($id)
    {
        return $this->render ('view', [
            'model' => $this->findModel ($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate ()
    {
        $model = new Task();

        if ($model->load (Yii::$app->request->post ())) {
            //if($model->delivery_date)
            $students = $_POST['Task']['students'];
            foreach ($students as $value) {

                $model->setIsNewRecord (true);
                $model->id = null;
                $model->status = Task::NEWTASK;
                $project = Registration::find ()->where ("student_id=" . $value)->one ();
                $model->project_id = $project->project_id;


                $model->save ();

                Yii::$app->db->createCommand ()->insert ('student_evidence', [
                    'task_id' => $model->id,
                    'project_id' => $model->project_id,
                    'evidence_id' => null,
                    'student_id' => $value
                ])->execute ();

                Yii::$app->getSession ()->setFlash ('success', 'Petición creada exitosamente');
            }
            return $this->redirect (['index']);


        } else {
            return $this->render ('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate ($id)
    {
        $model = $this->findModel ($id);

        if ($model->load (Yii::$app->request->post ()) && $model->save ()) {
            return $this->redirect (['view', 'id' => $model->id]);
        } else {
            return $this->render ('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete ($id)
    {
        $this->findModel ($id)->delete ();

        return $this->redirect (['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ($id)
    {
        if (($model = Task::findOne ($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSelectProject ()
    {
        $model = new Task();
        $project = $_POST['list'];
        if (Registration::find ()->where ("project_id=" . $project)->all ()) {
            return $this->render ('create', [
                'model' => $model,
                'project_id' => $project,
            ]);
        } else {
            Yii::$app->getSession ()->setFlash ('danger', 'No hay estudiantes en el proyecto seleccionado ');
            return $this->redirect (['index']);
        }
    }

    public function actionGiveFeedback ($id)
    {
        $task = $this->findModel ($id);


        $comment = $_POST['feedback'];
        $accepted = $_POST['aceptado'];
        $studentEvidence = StudentEvidence::find ()
            ->where ("task_id=" . $task->id)
            ->one ();
        $evidence_id = $studentEvidence->evidence_id;

        if ($accepted == 1) {

            Yii::$app->db->createCommand ()->update ('student_evidence', ['comment' => $comment], 'task_id=' . $task->id)->execute ();

            $task->status = Task::ACCEPTED;
            $task->update ();

            $evidence = Evidence::find ()
                ->where ("id=" . $evidence_id)
                ->one ();
            $evidence->status = Task::ACCEPTED;
            $evidence->accepted_date = Yii::$app->formatter->asDate ('now', 'yyyy-MM-dd');
            $evidence->update ();
            Yii::$app->getSession ()->setFlash ('success', 'Sus cambios se han guardado exitosamente');

        } else {
            $studentEvidence->comment = $comment;
            $studentEvidence->update ();
            Yii::$app->getSession ()->setFlash ('success', 'Sus cambios se han guardado exitosamente');
        }


        return $this->redirect (['index']);

    }

    public function actionShowFeedbackScreen ($id)
    {
        return $this->render ('feedback', [
            'model' => $this->findModel ($id),
        ]);
    }

    public function actionDownload ($evidence_id)
    {
        $student_evidence = StudentEvidence::find ()->where ("evidence_id=" . $evidence_id)
            ->one ();
        return Yii::$app->response->sendFile (
            Yii::getAlias ('@webroot') . $student_evidence->evidence->attachment_path,
            $student_evidence->evidence->attachment_name
        )->send ();
    }

}
