<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentEvidence */

$this->title = 'Registrar avance';
$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="student-evidence-create">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <h2>Tarea <?= $student_evidence->task->name ?></h2>


    <div class="row">
        <div class="col-md-12">
            <div class="student-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


                <?= $form->field($evidence, 'description')->textarea() ?>

                <?= $form->field($evidence, 'file')->fileInput(['required' => true]) ?>

                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <?= Html::a('Cancelar', '#', ['class' => 'btn btn-danger']) ?>
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
