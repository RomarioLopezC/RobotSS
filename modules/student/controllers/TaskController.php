<?php

namespace app\modules\student\controllers;

use app\models\StudentEvidence;
use Yii;
use yii\web\Controller;

/**
 * StudentEvidenceController implements the CRUD actions for StudentEvidence model.
 */
class TaskController extends Controller
{

    /**
     * Displays a single StudentEvidence model.
     * @param integer $task_id, $project_id, $student_id.
     * @return mixed
     * http://localhost/RobotSS/web/student/task/view?task_id=1&project_id=1&student_id=1
     */
    public function actionView($task_id, $project_id, $student_id)
    {
        return $this->render('view', [
            'model' => StudentEvidence::findOne(['task_id' => $task_id, 'project_id' => $project_id, 'student_id' => $student_id])
        ]);
    }

    /**
     * Creates a new StudentEvidence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentEvidence();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'task_id' => $model->task_id, 'project_id' => $model->project_id, 'evidence_id' => $model->evidence_id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}
