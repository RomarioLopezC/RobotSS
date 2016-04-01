<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin ([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field ($model, 'id') ?>

    <?= $form->field ($model, 'user_id') ?>

    <?= $form->field ($model, 'faculty_id') ?>

    <?= $form->field ($model, 'current_semester') ?>

    <?= $form->field ($model, 'enrollment_id') ?>

    <div class="form-group">
        <?= Html::submitButton ('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton ('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end (); ?>

</div>
