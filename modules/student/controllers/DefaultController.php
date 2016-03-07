<?php

namespace app\modules\student\controllers;

use app\models\Degree;
use app\models\Person;
use app\models\Project;
use app\models\ProjectManager;
use app\models\Registration;
use app\models\Student;
use app\models\StudentSearch;
use app\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class DefaultController extends Controller {
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex () {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search (Yii::$app->request->queryParams);

        return $this->render ('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView ($id) {
        return $this->render ('view', [
            'model' => $this->findModel ($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate () {
        $student = new Student();
        $user = new User();
        $person = new Person();

        if (Yii::$app->request->post ()) {
            $params = Yii::$app->request->post ();

            $person->load ($params);
            $user->load ($params);
            $user->password_hash = Yii::$app->getSecurity ()->generatePasswordHash ($params['User']['password_hash']);
            $student->load ($params);

            if ($person->validate () && $user->validate () && $student->validate ()) {

                $person->save (false);
                $user->person_id = $person->id;
                $user->register ();
                $student->user_id = $user->id;
                $student->save ();

                Yii::$app->session->setFlash ('success',
                    'Se envío un correo de confirmación. Por favor verifique su correo electrónico');
                return $this->refresh ();
            } else {
                Yii::$app->session->setFlash ('danger', 'Ocurrió ff un error al guardar. Vuelve a intentar');
                return $this->refresh ();
            }

        } else {
            return $this->render ('create', [
                'student' => $student,
                'user' => $user,
                'person' => $person
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate ($id) {
        $student = Student::findOne ($id);
        $user = $student->getUser ();
        $person = $user->getPerson ();


        if (Yii::$app->request->post ()) {
            $person->name = Yii::$app->request->post ()['Person']['name'];
            $person->lastname = Yii::$app->request->post ()['Person']['lastname'];
            $person->phone = Yii::$app->request->post ()['Person']['phone'];
            if ($person->save (false)) {
                $user->username = Yii::$app->request->post ()['User']['username'];
                $user->password = Yii::$app->request->post ()['User']['password'];
                $user->email = Yii::$app->request->post ()['User']['email'];
                $user->person_id = $person->getPrimaryKey ();
                $user->scenario = 'connect';
                if ($user->register ()) {
                    $student->load (Yii::$app->request->post ());
                    $student->user_id = $user->id;
                    $student->save (false);
                    return $this->redirect (['index']);
                } else {
                    return $this->render ('create', [
                        'student' => $student,
                        'user' => $user,
                        'person' => $person
                    ]);
                }
            }
            return $this->redirect (['view', 'id' => $student->getPrimaryKey ()]);
        } else {
            return $this->render ('update', [
                'student' => $student,
                'user' => $user,
                'person' => $person
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete ($id) {
        $this->findModel ($id)->delete ();

        return $this->redirect (['index']);
    }

    /**
     * @return mixed|\yii\web\Response
     */
    public function actionPrintPreregistrationPDF () {
        $student = Student::findOne (['user_id' => Yii::$app->user->id]);
        date_default_timezone_set ("America/Mexico_City");
        try {
            $registration = Registration::findOne (['student_id' => $student->id]);
            $person = Person::findOne (User::findOne (Yii::$app->user->id)->person_id);
            $degree = Degree::findOne ($student->degree_id);

            $user = User::findOne (Yii::$app->user->id);
            $project = Project::findOne ($registration->project_id);
            $projectM = ProjectManager::findOne ($project->manager_id);
            $content = $this->render ('preregistrationPDF', [
                'student' => $student,
                'person' => $person,
                'degree' => $degree,
                'project' => $project,
                'projectM' => $projectM,
                'user' => $user
            ]);


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
                'options' => ['title' => 'Carta de Preregistro'],
                // call mPDF methods on the fly

            ]);

            // return the pdf output as per the destination setting
            return $pdf->render ();
        } catch (InvalidConfigException $e) {
            Yii::$app->getSession ()->setFlash ('danger', 'No tienes preregistros realizados');
            return $this->redirect (Url::home ());
        }
    }

    /**
     * @return mixed|\yii\web\Response
     */
    public function actionPrintProjectAssignmentPDF () {
        $student = Student::findOne (['user_id' => Yii::$app->user->id]);
        date_default_timezone_set ("America/Mexico_City");
        try {
            $registration = Registration::findOne (['student_id' => $student->id]);
            $person = Person::findOne (User::findOne (Yii::$app->user->id)->person_id);
            $degree = Degree::findOne ($student->degree_id);

            $project = Project::findOne ($registration->project_id);
            $projectM = ProjectManager::findOne ($project->manager_id);

            // get your HTML raw content without any layouts or scripts
            $content = $this->render ('projectAssignmentPDF', [
                'registration' => $registration,
                'student' => $student,
                'person' => $person,
                'degree' => $degree,
                'project' => $project,
                'projectM' => $projectM
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
                'options' => ['title' => 'Carta de Asignación'],
                // call mPDF methods on the fly
                'methods' =>
                    [
                        //'SetHeader' => ['Carta de Asignación al Servicio Social'],
                        'SetFooter' => ['Fecha de expedición: ' . $formatter->asDate (date ('Y-m-d'), 'long')],
                    ]
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render ();
        } catch (InvalidConfigException $e) {
            Yii::$app->getSession ()->setFlash ('danger', 'No tienes proyectos asignados');
            return $this->redirect (Url::home ());
        }
    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionSetBeginningAndEndingDates () {
        $beginningDate = new \DateTime(Yii::$app->request->post ('Registration')['beginning_date']);
        $endingDate = new \DateTime(Yii::$app->request->post ('Registration')['ending_date']);
        $interval = $beginningDate->diff ($endingDate);
        $daysBetweenDates = $interval->format ('%a');
        if ($daysBetweenDates > 180) {
            try {
                $student = Student::findOne (['user_id' => Yii::$app->user->id]);
                $registration = Registration::findOne (['student_id' => $student->id]);
                $registration->beginning_date = Yii::$app->request->post ('Registration')['beginning_date'];
                $registration->ending_date = Yii::$app->request->post ('Registration')['ending_date'];
                $registration->save (false);
                $this->actionPrintProjectAssignmentPDF ();
            } catch (InvalidConfigException $e) {
                throw new BadRequestHttpException('No se tiene asignado ningún proyecto');
            }
        } else {
            throw new BadRequestHttpException('Las fechas ingresadas no son válidas,
            deben tener una diferencia de al menos 6 meses');
        }
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ($id) {
        if (($model = Student::findOne ($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
