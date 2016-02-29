<?php

use app\models\Evidence;
use app\models\StudentEvidence;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = "Retroalimentación: " . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode ($this->title) ?></h1>


    <?= DetailView::widget ([
        'model' => $model,
        'attributes' => [

            'name',
            'description:ntext',

        ],
    ]) ?>

    <h1><?= Html::encode ($this->title) ?></h1>
    <?php

    //$studentEvidence = StudentEvidence::find()->where("task_id=" . $model->id)
    //    ->one();
    //$evidenceId = $studentEvidence->evidence_id;

    //$evidence = Evidence::find()->where("id=" . $evidenceId)
    //   ->one();
    echo DetailView::widget ([
        'model' => $evidence,
        'attributes' => [

            'description:ntext',


        ],
    ]); ?>
    <?= Html::label ('Archivo adjunto: ') ?>


    <?= Html::a ($evidence->attachment_name, ['download', 'evidenceId' => $evidence->id]); ?>

    <?= Html::beginForm (['give-feedback', 'id' => $model['id'],'evidenceId'=>$evidence['id']], 'post') ?>
    <?php
    $array = [['value' => 1, 'estado' => 'Aceptado'], ['value' => 2, 'estado' => 'No aceptado']];
    ?>
    <?= Html::label ('Aceptar avance?') ?>

    <?= Html::radioList ('aceptado', null, ArrayHelper::map ($array, 'value', 'estado'), ['class' => "form-control"]) ?>

    <?= Html::label ('Retroalimentación') ?>

    <?= Html::textarea ('feedback', null, ['class' => "form-control"]) ?>

    <?= Html::submitButton ('Guardar', ['class' => 'btn btn-success']) ?>

    <?= Html::endForm () ?>

</div>