<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;
use app\models\Registration;
use app\models\ProjectVacancy;
use app\models\Student;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Búsqueda de Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container-fluid">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php
    foreach(Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-'.$key,
            ],
            'body' => $message,
        ]);
    }
    ?>
    <div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <p><b>Nombre del Proyecto: </b> <?= $model->name ?></p>
        </div>

        <div class="col-lg-6">
            <p><b>Dependencia Solicitante: </b> <?= $model->dependency ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Prefiles Solicitados: </b></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Objetivos del Proyecto: </b> <?= $model->objective ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Meta(s) del Proyecto: </b> <?= $model->goals ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Acciones a realizar por los prestadores: </b> <?= $model->actions_by_students ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Inducción: </b> <?= $model->induction ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Recursos con los que dispondrá el prestador: </b> <?= $model->economic_support ?> </p>
        </div>
    </div>


    <?php if(Yii::$app->user->can('student')){
        $vacancy = ProjectVacancy::find()
            ->where("project_id=" .$model->id)
            ->one();
        //$vacancyValue=ArrayHelper::getColumn($vacancy, 'vacancy')[0];
        $vacancyValue=$vacancy->vacancy;
        if($vacancyValue>0) {
            $user = User::find()
                ->where("id=" .Yii::$app->user->id)
                ->one();
            $user_id=$user->id;
            $student = Student::find()
                ->where("user_id=" .$user_id)
                ->one();
            $student_id=$student->id;
            if(Registration::find()->where(['student_id' => $student_id])->one()) {
                echo Html::a('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id], ['class' => 'btn btn-success pull-right', 'disabled' => 'disabled']);
            }else{
                echo Html::a('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id], ['class' => 'btn btn-success pull-right']);
            }

            }else{
            echo Html::a('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id], ['class' => 'btn btn-success pull-right', 'disabled' => 'disabled']);
        }
        } ?>


            </div>

</div>
