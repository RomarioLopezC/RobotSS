<?php

use app\models\ProjectVacancy;
use app\models\Registration;
use app\models\Student;
use app\models\User;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Búsqueda de Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container-fluid">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>
    <?php
    foreach (Yii::$app->getSession ()->getAllFlashes () as $key => $message) {
        echo Alert::widget ([
            'options' => [
                'class' => 'alert-' . $key,
            ],
            'body' => $message,
        ]);
    }
    ?>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Datos Generales</h4>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <p><b>Nombre del Proyecto: </b></p>
                        </div>

                        <div class="col-lg-6">
                            <p><?= $model->name ?></p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-4">
                            <p><b>Dependencia Solicitante: </b></p>
                        </div>

                        <div class="col-lg-6">
                            <p><?= $model->dependency ?></p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Prefiles Solicitados: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <tbody>
                                <?php
                                foreach ($model->degrees as $degree) {
                                    echo '<tr>
                                                  <td>' . $degree->name . '</td>
                                              </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Inducción: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->induction ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Objetivos del Proyecto: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->objective ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Meta(s) del Proyecto: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->goals ?> </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Información para el prestador</h4>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Acciones a realizar por los prestadores: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->actions_by_students ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Recursos materiales: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->materials_for_students ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Recursos económicos: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->economic_support ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Recursos humanos: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->human_resource ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><b>Infraestructura: </b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p><?= $model->infraestructure ?> </p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-4">
                            <p><b>Monto de apoyo: </b></p>
                        </div>

                        <div class="col-lg-6">
                            <p><?= Yii::$app->formatter->asCurrency ($model->ammount) ?></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pull-right">
                <?= Html::a ('Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>

                <?php if (Yii::$app->user->can ('student')) {
                    $vacancy = ProjectVacancy::find ()
                        ->where ("project_id=" . $model->id)
                        ->one ();
                    //$vacancyValue=ArrayHelper::getColumn($vacancy, 'vacancy')[0];
                    $vacancyValue = $vacancy->vacancy;
                    if ($vacancyValue > 0) {
                        $user = User::find ()
                            ->where ("id=" . Yii::$app->user->id)
                            ->one ();
                        $user_id = $user->id;
                        $student = Student::find ()
                            ->where ("user_id=" . $user_id)
                            ->one ();
                        $student_id = $student->id;
                        if (Registration::find ()->where (['student_id' => $student_id])->one ()) {
                            echo Html::a ('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id],
                                ['class' => 'btn btn-success', 'disabled' => 'disabled']);
                        } else {
                            echo Html::a ('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id],
                                ['class' => 'btn btn-success']);
                        }

                    } else {
                        echo Html::a ('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id],
                            ['class' => 'btn btn-success', 'disabled' => 'disabled']);
                    }
                } ?>

            </div>


        </div>
    </div>

</div>
