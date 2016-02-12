<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dependency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objective')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goals')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actions_by_students')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'induction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'materials_for_students')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'economic_support')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'human_resource')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'infraestrcture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ammount')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
