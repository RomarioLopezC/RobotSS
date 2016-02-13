<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'dependency') ?>

    <?= $form->field($model, 'objective') ?>

    <?= $form->field($model, 'goals') ?>

    <?php // echo $form->field($model, 'actions_by_students') ?>

    <?php // echo $form->field($model, 'induction') ?>

    <?php // echo $form->field($model, 'materials_for_students') ?>

    <?php // echo $form->field($model, 'economic_support') ?>

    <?php // echo $form->field($model, 'human_resource') ?>

    <?php // echo $form->field($model, 'infraestructure') ?>

    <?php // echo $form->field($model, 'ammount') ?>

    <?php // echo $form->field($model, 'approved') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
