<?php
namespace app\modules\projectmanager\controllers;

use app\models\Evidence;
use app\models\Notification;
use app\models\Registration;
use app\models\Student;
use app\models\StudentEvidence;
use app\models\Task;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller {
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
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $projectId
     * @return mixed
     */
    public function actionCreate ($projectId) {
        $model = new Task();
        if ($model->load (Yii::$app->request->post ())) {
            if (strtotime ($model->delivery_date) >= strtotime (Yii::$app->formatter->asDate ('now', 'yyyy-MM-dd'))) {
                $students = $_POST['Task']['students'];
                $model->status = Task::NEW_TASK;
                $model->project_id = $projectId;
                $model->save ();
                foreach ($students as $value) {
                    Yii::$app->db->createCommand ()->insert ('student_evidence', [
                        'task_id' => $model->id,
                        'project_id' => $model->project_id,
                        'evidence_id' => null,
                        'student_id' => $value,
                        'status' => Task::NEW_TASK
                    ])->execute ();

                    $this->setNotification ($value, $model->id, $model->project_id, Notification::NEW_TASK);
                }
                Yii::$app->getSession ()->setFlash ('success', 'Petición creada exitosamente');
                return $this->redirect (['student-evidence/index']);
            } else {
                Yii::$app->getSession ()->setFlash ('danger',
                    'La fecha de entrega no puede ser anterior a la fecha actual');
                return $this->render ('create', [
                    'model' => $model,
                    'projectId' => $projectId,
                ]);
            }
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
    public function actionUpdate ($id) {
        $model = $this->findModel ($id);
        $projectId = $model->project_id;
        $studentIds = Yii::$app->db->createCommand ('SELECT * FROM student_evidence WHERE task_id=' . $model->id)
            ->queryAll ();
        //$ids =
        $model->students = ArrayHelper::getColumn ($studentIds, 'student_id');
        $status = Yii::$app->db->createCommand ('SELECT * FROM student_evidence WHERE task_id=' . $model->id)
            ->queryOne ();

        if ($model->load (Yii::$app->request->post ())) {
            if (strtotime ($model->delivery_date) >= strtotime (Yii::$app->formatter->asDate ('now', 'yyyy-MM-dd'))) {
                $students = $_POST['Task']['students'];
                $model->save ();
                foreach ($students as $value) {
                    if (!$status = StudentEvidence::findOne (['task_id' => $model->id, 'student_id' => $value])) {
                        Yii::$app->db->createCommand ()->insert ('student_evidence', [
                            'task_id' => $model->id,
                            'project_id' => $model->project_id,
                            'evidence_id' => null,
                            'student_id' => $value,
                            'status' => Task::NEW_TASK,
                        ])->execute ();
                    }

                    $this->setNotification ($value, $model->id, $model->project_id, Notification::EDITED_TASK);
                }
                Yii::$app->getSession ()->setFlash ('success', 'Petición actualizada exitosamente');
                return $this->redirect (['student-evidence/index']);
            } else {
                Yii::$app->getSession ()->setFlash ('danger',
                    'La fecha de entrega no puede ser anterior a la fecha actual');
                return $this->render ('update', [
                    'model' => $model,
                    'projectId' => $projectId,
                ]);
            }

        } else {
            return $this->render ('update', [
                'model' => $model,
                'projectId' => $projectId,
            ]);
        }
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ($id) {
        if (($model = Task::findOne ($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Selects the project where the task will be created
     * @return string|\yii\web\Response
     */
    public function actionSelectProject () {
        $model = new Task();
        $project = $_POST['list'];
        if (Registration::find ()->where ("project_id=" . $project)->all ()) {
            return $this->render ('create', [
                'model' => $model,
                'projectId' => $project,
            ]);
        } else {
            Yii::$app->getSession ()->setFlash ('danger', 'No hay estudiantes en el proyecto seleccionado ');
            return $this->redirect (['student-evidence/index']);
        }
    }

    /**
     * Saves feedback given by the project manager
     * Sends a notification for the student
     * @param $id
     * @param $evidenceId
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function actionGiveFeedback ($id, $evidenceId) {
        $task = $this->findModel ($id);
        $comment = $_POST['feedback'];
        $accepted = $_POST['aceptado'];

        $studentEvidence = StudentEvidence::findOne (['task_id' => $task->id]);

        $studentId = $studentEvidence->student_id;
        if ($accepted == 1) {

            Yii::$app->db->createCommand ('UPDATE student_evidence SET comment="' . $comment .
                '" WHERE task_id=' . $task->id . ' AND evidence_id=' . $evidenceId)
                ->execute ();
            $task->status = Task::ACCEPTED;
            Yii::$app->db->createCommand ('UPDATE student_evidence SET status="' .
                Task::ACCEPTED . '" WHERE task_id=' . $task->id . ' AND evidence_id=' . $evidenceId)
                ->execute ();
            $task->update ();
            $evidence = Evidence::find ()
                ->where ("id=" . $evidenceId)
                ->one ();

            $evidence->accepted_date = Yii::$app->formatter->asDate ('now', 'yyyy-MM-dd');
            $evidence->update ();

            $this->setNotification ($studentId, $task->id, $studentEvidence->project_id, Notification::ACCEPTED_TASK);


            Yii::$app->getSession ()->setFlash ('success', 'Sus cambios se han guardado exitosamente');
        } else {

            Yii::$app->db->createCommand ('UPDATE student_evidence SET comment="' . $comment .
                '" WHERE task_id=' . $task->id . ' AND evidence_id=' . $evidenceId)
                ->execute ();
            $this->setNotification ($studentId, $task->id, $studentEvidence->project_id, Notification::REJECTED_TASK);
            Yii::$app->getSession ()->setFlash ('success', 'Sus cambios se han guardado exitosamente');
        }


        return $this->redirect (['student-evidence/index']);
    }

    /**
     * Shows feedback screen for the selected task
     * @param $taskId
     * @param $evidenceId
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShowFeedbackScreen ($taskId, $evidenceId) {
        return $this->render ('feedback', [
            'model' => $this->findModel ($taskId),
            'evidence' => Evidence::find ()->where ("id=" . $evidenceId)->one ()
        ]);
    }

    /**
     * Downloads selected file
     * @param $evidenceId
     */
    public function actionDownload ($evidenceId) {
        $studentEvidence = StudentEvidence::find ()->where ("evidence_id=" . $evidenceId)
            ->one ();
        return Yii::$app->response->sendFile (Yii::getAlias ('@webroot') .
            $studentEvidence->evidence->attachment_path,
            $studentEvidence->evidence->attachment_name)
            ->send ();
    }

    /**
     * @param $studentId
     * @param $task
     * @param $studentEvidence
     * @throws \yii\base\InvalidConfigException
     */
    private function setNotification ($studentId, $taskId, $proyectId, $description) {
        $notification = Yii::createObject ([
            'class' => Notification::className (),
            'user_id' => Student::findOne ([$studentId])->user_id,
            'description' => $description,
            'role' => Notification::ROLE_STUDENT,
            'created_at' => Yii::$app->formatter->asDate ('now', 'yyyy-MM-dd'),
            'viewed' => false,
            'url' => Url::to (['/student/student-evidence/view',
                'task_id' => $taskId,
                'project_id' => $proyectId,
                'student_id' => $studentId
            ])
        ]);
        $notification->save (false);
    }
}