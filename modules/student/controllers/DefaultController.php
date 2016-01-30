<?php

namespace app\modules\student\controllers;

use app\models\Person;
use app\models\User;
use Yii;
use app\models\Student;
use app\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class DefaultController extends Controller
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $student = new Student();
        $user = new User();
        $person = new Person();


        if (Yii::$app->request->post()) {
            $person->name = Yii::$app->request->post()['Person']['name'];
            $person->lastname = Yii::$app->request->post()['Person']['lastname'];
            $person->phone = Yii::$app->request->post()['Person']['phone'];
            if($person->save(false)){
                $user->username = Yii::$app->request->post()['User']['username'];
                $user->password = Yii::$app->request->post()['User']['password'];
                $user->email = Yii::$app->request->post()['User']['email'];
                $user->person_id = $person->getPrimaryKey();
                $user->scenario = 'connect';
                if($user->register()){
                    $student->load(Yii::$app->request->post());
                    $student->user_id = $user->id;
                    $student->save(false);
                    return $this->redirect(['index']);
                } else {
                    return $this->render('create', [
                        'student' => $student,
                        'user' => $user,
                        'person' => $person
                    ]);
                }
            }
            return $this->redirect(['view', 'id' => $student->getPrimaryKey()]);
        } else {
            return $this->render('create', [
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
    public function actionUpdate($id)
    {
        $student = Student::findOne($id);
        $user = $student->getUser();
        $person = $user->getPerson();


        if (Yii::$app->request->post()) {
            $person->name = Yii::$app->request->post()['Person']['name'];
            $person->lastname = Yii::$app->request->post()['Person']['lastname'];
            $person->phone = Yii::$app->request->post()['Person']['phone'];
            if($person->save(false)){
                $user->username = Yii::$app->request->post()['User']['username'];
                $user->password = Yii::$app->request->post()['User']['password'];
                $user->email = Yii::$app->request->post()['User']['email'];
                $user->person_id = $person->getPrimaryKey();
                $user->scenario = 'connect';
                if($user->register()){
                    $student->load(Yii::$app->request->post());
                    $student->user_id = $user->id;
                    $student->save(false);
                    return $this->redirect(['index']);
                } else {
                    return $this->render('create', [
                        'student' => $student,
                        'user' => $user,
                        'person' => $person
                    ]);
                }
            }
            return $this->redirect(['view', 'id' => $student->getPrimaryKey()]);
        } else {
            return $this->render('update', [
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
