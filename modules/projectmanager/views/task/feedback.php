<?php

use app\models\Evidence;
use app\models\StudentEvidence;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = "Retroalimentación: " . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['/project_manager/student-evidence/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php
    foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-' . $key,
            ],
            'body' => $message,
        ]);
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            'description:ntext',

        ],
    ]) ?>


    <?php

    echo DetailView::widget([
        'model' => $evidence,
        'attributes' => [

            'description:ntext',


        ],
    ]); ?>
    <?= Html::label('Archivo adjunto: ') ?>


    <?= Html::a($evidence->attachment_name, ['download', 'evidenceId' => $evidence->id]); ?>
    <br><br>
    <?= Html::beginForm(['give-feedback', 'id' => $model['id'], 'evidenceId' => $evidence['id']], 'post') ?>
    <?php
    $array = [['value' => 1, 'estado' => 'Aceptado'], ['value' => 2, 'estado' => 'No aceptado']];
    ?>
    <?= Html::label('Aceptar avance?') ?>

    <?= Html::radioList('aceptado', 1, ArrayHelper::map($array, 'value', 'estado'),
        ['class' => "form-control", 'required' => true]) ?>

    <br>
    <?= Html::label('Retroalimentación') ?>
    <br>

    <?= Html::textarea('feedback', null, ['class' => "form-control", 'required' => true]) ?>
    <br>
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success pull-right']) ?>

    <?= Html::endForm() ?>

</div>