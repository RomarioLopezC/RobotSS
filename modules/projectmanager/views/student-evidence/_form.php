<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentEvidence */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-evidence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'evidence_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
