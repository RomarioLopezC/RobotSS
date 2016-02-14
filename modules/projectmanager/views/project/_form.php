<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Degree;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">
    <div class="row">
    <div class="col-lg-7">
        <div class="panel panel-default">
    <div class="panel-heading">
        <h4>Datos Generales</h4>
    </div>

    <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dependency')->textInput(['maxlength' => true]) ?>

    <?php
    //$options = \yii\helpers\ArrayHelper::map($model->degrees, 'id', 'name');


    //$form->field($model, 'degrees')->checkboxList($options, ['unselect'=>NULL])

    Modal::begin([
        'header' => '<h2>Perfiles solicitados</h2>',
        'toggleButton' => [
            'label' =>'Perfiles solicitados',
            'class' => 'btn btn-success'
        ],
    ]);

    echo $form->field($model, 'degrees')->checkboxList(ArrayHelper::map(Degree::find()->all(), 'id', 'name'));

    Modal::end();

    ?>

    <?= $form->field($model, 'vacancy')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'objective')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goals')->textInput(['maxlength' => true]) ?>

    </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="panel panel-default">
    <div class="panel-heading">
        <h4>Información para el prestador</h4>
    </div>

    <div class="panel-body">

    <?= $form->field($model, 'actions_by_students')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'induction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'materials_for_students')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'economic_support')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'human_resource')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'infraestructure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ammount')->textInput(['maxlength' => true]) ?>

    </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>
    </div>

</div>
