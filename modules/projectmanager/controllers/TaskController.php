<?php
namespace app\modules\projectmanager\controllers;

use Yii;
use app\models\Notification;
use app\models\Student;
use yii\helpers\Url;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentEvidence;
use app\models\Registration;
use app\models\Evidence;
use yii\helpers\ArrayHelper;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller {
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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('student-evidence/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($projectId) {
        $model = new Task();
        if ($model->load(Yii::$app->request->post())) {
            if (strtotime($model->delivery_date) >= strtotime(Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'))) {
                $students = $_POST['Task']['students'];
                $model->status = Task::NEW_TASK;
                $model->project_id = $projectId;
                $model->save();
                foreach ($students as $value) {
                    Yii::$app->db->createCommand()->insert('student_evidence', [
                        'task_id' => $model->id,
                        'project_id' => $model->project_id,
                        'evidence_id' => null,
                        'student_id' => $value,
                        'status' => Task::NEW_TASK
                    ])->execute();

                    $notification = Yii::createObject([
                        'class' => Notification::className(),
                        'user_id' => Student::findOne([$value])->user_id,
                        'description' => Notification::NEW_TASK,
                        'role' => Notification::ROLE_STUDENT,
                        'created_at' => Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'),
                        'viewed' => false,
                        'url' => Url::to(['/student/student-evidence/view',
                            'task_id' => $model->id,
                            'project_id' => $model->project_id,
                            'student_id' => $value
                        ])
                    ]);

                    $notification->save(false);
                }
                Yii::$app->getSession()->setFlash('success', 'Petición creada exitosamente');
                return $this->redirect(['student-evidence/index']);
            } else {
                Yii::$app->getSession()->setFlash('danger',
                    'La fecha de entrega no puede ser anterior a la fecha actual');
                return $this->render('create', [
                    'model' => $model,
                    'projectId' => $projectId,
                ]);
            }
        } else {
            return $this->render('create', [
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
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $projectId = $model->project_id;
        $studentIds = Yii::$app->db->createCommand('SELECT * FROM student_evidence WHERE task_id=' . $model->id)
            ->queryAll();
        $ids = ArrayHelper::getColumn($studentIds, 'student_id');
        $model->students = $ids;
        $status = Yii::$app->db->createCommand('SELECT * FROM student_evidence WHERE task_id=' . $model->id)
            ->queryOne();

        if ($model->load(Yii::$app->request->post())) {
            if (strtotime($model->delivery_date) >= strtotime(Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'))) {
                $students = $_POST['Task']['students'];
                $model->save();
                foreach ($students as $value) {
                    if (!$status = StudentEvidence::findOne(['task_id' => $model->id, 'student_id' => $value])) {
                        Yii::$app->db->createCommand()->insert('student_evidence', [
                            'task_id' => $model->id,
                            'project_id' => $model->project_id,
                            'evidence_id' => null,
                            'student_id' => $value,
                            'status' => Task::NEW_TASK,
                        ])->execute();
                    }

                    $notification = Yii::createObject([
                        'class' => Notification::className(),
                        'user_id' => Student::findOne([$value])->user_id,
                        'description' => Notification::EDITED_TASK,
                        'role' => Notification::ROLE_STUDENT,
                        'created_at' => Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'),
                        'viewed' => false,
                        'url' => Url::to(['/student/student-evidence/view',
                            'task_id' => $model->id,
                            'project_id' => $model->project_id,
                            'student_id' => $value
                        ])
                    ]);

                    $notification->save(false);
                }
                Yii::$app->getSession()->setFlash('success', 'Petición actualizada exitosamente');
                return $this->redirect(['student-evidence/index']);
            } else {
                Yii::$app->getSession()->setFlash('danger',
                    'La fecha de entrega no puede ser anterior a la fecha actual');
                return $this->render('update', [
                    'model' => $model,
                    'projectId' => $projectId,
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'projectId' => $projectId,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['student-evidence/index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSelectProject() {
        $model = new Task();
        $project = $_POST['list'];
        if (Registration::find()->where("project_id=" . $project)->all()) {
            return $this->render('create', [
                'model' => $model,
                'projectId' => $project,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'No hay estudiantes en el proyecto seleccionado ');
            return $this->redirect(['student-evidence/index']);
        }
    }

    public function actionGiveFeedback($id, $evidenceId) {
        $task = $this->findModel($id);
        $comment = $_POST['feedback'];
        $accepted = $_POST['aceptado'];

        $studentEvidence = StudentEvidence::findOne(['task_id' => $task->id]);

        $studentId = $studentEvidence->student_id;
        if ($accepted == 1) {

            Yii::$app->db->createCommand('UPDATE student_evidence SET comment="' . $comment .
                '" WHERE task_id=' . $task->id . ' AND evidence_id=' . $evidenceId)
                ->execute();
            $task->status = Task::ACCEPTED;
            Yii::$app->db->createCommand('UPDATE student_evidence SET status="' .
                Task::ACCEPTED . '" WHERE task_id=' . $task->id . ' AND evidence_id=' . $evidenceId)
                ->execute();
            $task->update();
            $evidence = Evidence::find()
                ->where("id=" . $evidenceId)
                ->one();

            $evidence->accepted_date = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
            $evidence->update();

            //set notification
            $notification = Yii::createObject([
                'class' => Notification::className(),
                'user_id' => Student::findOne([$studentId])->user_id,
                'description' => Notification::ACCEPTED_TASK,
                'role' => Notification::ROLE_STUDENT,
                'created_at' => Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'),
                'viewed' => false,
                'url' => Url::to(['/student/student-evidence/view',
                    'task_id' => $task->id,
                    'project_id' => $studentEvidence->project_id,
                    'student_id' => $studentId
                ])
            ]);
            $notification->save(false);

            Yii::$app->getSession()->setFlash('success', 'Sus cambios se han guardado exitosamente');
        } else {

            Yii::$app->db->createCommand('UPDATE student_evidence SET comment="' . $comment .
                '" WHERE task_id=' . $task->id . ' AND evidence_id=' . $evidenceId)
                ->execute();
            //set notification
            $notification = Yii::createObject([
                'class' => Notification::className(),
                'user_id' => Student::findOne([$studentId])->user_id,
                'description' => Notification::REJECTED_TASK,
                'role' => Notification::ROLE_STUDENT,
                'created_at' => Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'),
                'viewed' => false,
                'url' => Url::to(['/student/student-evidence/view',
                    'task_id' => $task->id,
                    'project_id' => $studentEvidence->project_id,
                    'student_id' => $studentId
                ])
            ]);
            $notification->save(false);
            Yii::$app->getSession()->setFlash('success', 'Sus cambios se han guardado exitosamente');
        }


        return $this->redirect(['student-evidence/index']);
    }

    public function actionShowFeedbackScreen($taskId, $evidenceId) {
        return $this->render('feedback', [
            'model' => $this->findModel($taskId),
            'evidence' => Evidence::find()->where("id=" . $evidenceId)->one()
        ]);
    }

    public function actionDownload($evidenceId) {
        $studentEvidence = StudentEvidence::find()->where("evidence_id=" . $evidenceId)
            ->one();
        return Yii::$app->response->sendFile(
            Yii::getAlias('@webroot') . $studentEvidence->evidence->attachment_path,
            $studentEvidence->evidence->attachment_name
        )->send();
    }
}