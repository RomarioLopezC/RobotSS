<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = 'Solicitud cuenta de Alumno';
?>
<div class="student-create">
    <div class="well well-sm col-md-12">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>

    <br>

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
        <div class="col-md-4">
            <?= Html::img ('../../images/uady-logo.jpg', ['class' => 'img-responsive']) ?>
        </div>

        <div class="col-md-7 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Datos Generales</h4>
                </div>

                <div class="panel-body">
                    <?= $this->render ('_form', [
                        'student' => $student,
                        'person' => $person,
                        'user' => $user
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
