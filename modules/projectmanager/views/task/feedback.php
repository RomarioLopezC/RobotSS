<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = "Retroalimentación: ".$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [

        'name',
        'description:ntext',

    ],
]) ?>
        <?php

        $evidencia=\app\models\StudentEvidence::find()->where("task_id=" . $model->id)
            ->one();
        $id_evid=$evidencia->evidence_id;

        $evidence=\app\models\Evidence::find()->where("id=" . $id_evid)
            ->one();
        echo DetailView::widget([
            'model' => $evidence,
            'attributes' => [

                'description:ntext',
                'attachment_path',



            ],
        ]); ?>

        <?= Html::beginForm(['give-feedback','id' => $model['id']], 'post') ?>
        <?php
        $array=[['value'=>1,'estado'=>'Aceptado'],['value'=>2,'estado'=>'No aceptado']];
        ?>
        <?= Html::label('Aceptar avance?')?>

        <?= Html::radioList('aceptado', null , ArrayHelper::map($array, 'value', 'estado'),['class'=>"form-control"]) ?>

        <?= Html::label('Retroalimentación')?>

        <?= Html::textarea('feedback',null,['class'=>"form-control"])?>

        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

        <?= Html::endForm() ?>

    </div>