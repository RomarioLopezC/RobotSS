<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Project;
use app\models\Registration;
use app\models\ProjectManager;


/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin (); ?>

    <?= $form->field ($model, 'name')->textInput (['maxlength' => true]) ?>

    <?= $form->field ($model, 'description')->textarea (['rows' => 6]) ?>

    <?= $form->field ($model, 'delivery_date')->widget (\yii\jui\DatePicker::classname (), [

        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton ($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end (); ?>

</div>