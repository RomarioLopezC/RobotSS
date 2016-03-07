<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentEvidence */

$this->title = 'Visualizar Avance';
$this->params['breadcrumbs'][] = ['label' => 'Avances de proyecto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-evidence-view">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            Estado:
            <?php if ($model->status == null): ?>
                Nuevo
            <?php else:
                print $model->status;
            endif; ?>
        </div>
        <div class="col-md-6 text-right">
            Fecha límite de
            entrega: <?php print Yii::$app->formatter->asDate($model->task->delivery_date, 'php: d/F/Y') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Descripción</div>
                <div class="panel-body">
                    <?php print $model->task->description ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Avance</div>
                <div class="panel-body">
                    <?php if ($model->evidence_id == null): ?>
                        No se ha registrado un avance
                    <?php else:
                        print $model->evidence->description;
                    endif; ?>
                </div>
                <div class="panel-footer text-right">
                    <?php if ($model->evidence_id): ?>
                        <h4 style="display: inline">
                            Archivo:</h4> <?= Html::a('Descarga ' . $model->evidence->attachment_name,
                            ['download', 'evidence_id' => $model->evidence_id]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-right">
        <div class="col-md-12">
            <?= Html::a('Regresar', ['index'],
                ['class' => 'btn btn-warning']);
            ?>
            <?php
            if ($model->evidence_id == null) {
                print Html::a('Registrar avance', ['create', 'task_id' => $model->task_id,
                    'project_id' => $model->project_id, 'student_id' => $model->student_id],
                    ['class' => 'btn btn-primary']);
            } else {
                print Html::a('Editar avance', ['update', 'evidence_id' => $model->evidence_id],
                    ['class' => 'btn btn-primary']);
            }
            ?>
        </div>
    </div>

</div>
