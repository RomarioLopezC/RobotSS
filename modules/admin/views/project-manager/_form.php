<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectManager */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-manager-form">

    <?php $form = ActiveForm::begin (); ?>

    <?= $form->field ($model, 'id')->textInput () ?>

    <?= $form->field ($model, 'user_id')->textInput () ?>

    <?= $form->field ($model, 'organization')->textInput (['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton ($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end (); ?>

</div>
