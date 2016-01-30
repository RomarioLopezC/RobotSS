<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = 'Solicitud cuenta de Alumno';
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-4">
        <?= Html::img('images/uady-logo.jpg') ;?>
    </div>

    <div class="col-md-8">
        <?= $this->render('_form', [
            'student' => $student,
            'person' => $person,
            'user' => $user
        ]) ?>
    </div>


</div>
