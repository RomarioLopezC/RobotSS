<?php

namespace app\modules\student\controllers;

use app\models\Evidence;
use app\models\Person;
use app\models\Project;
use app\models\ProjectManager;
use app\models\Registration;
use app\models\Student;
use app\models\StudentEvidence;
use app\models\StudentEvidenceSearch;
use app\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * StudentEvidenceController implements the CRUD actions for StudentEvidence model.
 */
class StudentEvidenceController extends Controller
{
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
     * Lists all StudentEvidence models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentEvidenceSearch();
        $dataProviderNews = $searchModel->searchNews(Yii::$app->request->queryParams);
        $dataProviderPending = $searchModel->searchPending(Yii::$app->request->queryParams);
        $dataProviderAccepted = $searchModel->searchAccepted(Yii::$app->request->queryParams);

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
     * @param integer $student_id
     * @return mixed
     * http://localhost/RobotSS/web/student/student-evidence/view?task_id=1&project_id=1&student_id=1
     */
    public function actionView($task_id, $project_id, $student_id)
    {
        $session = Yii::$app->session;
        $session->set('task_id', $task_id);
        $session->set('project_id', $project_id);
        $session->set('student_id', $student_id);

        return $this->render('view', [
            'model' => $this->findModelWithoutEvidence($task_id, $project_id, $student_id),
        ]);
    }

    /**
     * Creates a new StudentEvidence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($task_id, $project_id, $student_id)
    {
        $student_evidence = $this->findModelWithoutEvidence($task_id, $project_id, $student_id);

        $evidence = new Evidence();

        if (Yii::$app->request->post()) {
            $params = Yii::$app->request->post();
            $evidence->load($params);
            //Cambiar estado de evidencia a pendiente
            $evidence->status = Evidence::$PENDING;

            $evidence->file = UploadedFile::getInstance($evidence, 'file');
            if ($evidence->validate() && $evidence->save()) {

                $evidence->file->saveAs(Yii::getAlias('@webroot') . '/uploads/evidence/' . $evidence->id . '.' . $evidence->file->extension);
                $evidence->attachment_path = '/uploads/evidence/' . $evidence->id . '.' . $evidence->file->extension;
                $evidence->update(false);

                $student_evidence->evidence_id = $evidence->id;
                $student_evidence->update();

                return $this->redirect(['view', 'task_id' => $student_evidence->task_id, 'project_id' => $student_evidence->project_id, 'student_id' => $student_evidence->student_id]);
            } else {
                Yii::$app->session->setFlash('danger', 'Ocurrió un error al guardar. Vuelve a intentar');
                echo $evidence->validate();
                return $this->render('create', [
                    'student_evidence' => $student_evidence,
                    'evidence' => $evidence,
                ]);
            }
        } else {
            return $this->render('create', [
                'student_evidence' => $student_evidence,
                'evidence' => $evidence,
            ]);
        }
    }

    /**
     * Updates an existing StudentEvidence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $evidence_id
     * @return mixed
     */
    public function actionUpdate($evidence_id)
    {
        $model = $this->findModelByEvidence($evidence_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'task_id' => $model->task_id, 'project_id' => $model->project_id, 'evidence_id' => $model->evidence_id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDownload($evidence_id)
    {
        $studentEvidence = $this->findModelByEvidence($evidence_id);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $studentEvidence->evidence->attachment_path)->send();
    }

    public function actionPrintEvidenceReport()
    {
        $student = Student::findOne(['user_id' => Yii::$app->user->id]);
        date_default_timezone_set("America/Mexico_City");
        try {
            $searchModel = new StudentEvidenceSearch();
            $dataProviderAccepted = $searchModel->searchAccepted(Yii::$app->request->queryParams);

            $registration = Registration::findOne(['student_id' => $student->id]);
            $person = Person::findOne(User::findOne(Yii::$app->user->id)->person_id);

            $project = Project::findOne($registration->project_id);
            $projectM = ProjectManager::findOne($project->manager_id);

            // get your HTML raw content without any layouts or scripts
            $content = $this->render('studentEvidencePDF', [
                'registration' => $registration,
                'student' => $student,
                'person' => $person,
                'project' => $project,
                'projectM' => $projectM,
                'searchModel' => $searchModel,
                'dataProviderAccepted' => $dataProviderAccepted
            ]);

            $formatter = \Yii::$app->formatter;
            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_UTF8,
                // A4 paper format
                'format' => Pdf::FORMAT_LETTER,
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Reporte de avances'],
                // call mPDF methods on the fly
                'methods' =>
                    [
                        //'SetHeader' => ['Carta de Asignación al Servicio Social'],
                        'SetFooter' => ['Fecha de expedición: ' . $formatter->asDate(date('Y-m-d'), 'long')],
                    ]
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        } catch (InvalidConfigException $e) {
            Yii::$app->getSession()->setFlash('danger', 'No tienes proyectos asignados');
            return $this->redirect(Url::home());
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
    public function actionDelete($task_id, $project_id, $evidence_id, $student_id)
    {
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
    protected function findModel($task_id, $project_id, $evidence_id, $student_id)
    {
        if (($model = StudentEvidence::findOne(['task_id' => $task_id, 'project_id' => $project_id, 'evidence_id' => $evidence_id, 'student_id' => $student_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelWithoutEvidence($task_id, $project_id, $student_id)
    {
        if (($model = StudentEvidence::findOne(['task_id' => $task_id, 'project_id' => $project_id, 'student_id' => $student_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelByEvidence($evidence_id)
    {
        if (($model = StudentEvidence::findOne(['evidence_id' => $evidence_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
