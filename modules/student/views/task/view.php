<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentEvidence */

$this->title = 'Visualizar Avance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-evidence-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            Estado:
            <?php if ($model->evidence_id == null): ?>
                Nuevo
            <?php else:
                print $model->evidence->status;
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
                    DESCARGA
                </div>
            </div>
        </div>
    </div>

    <div class="row text-right">
        <div class="col-md-12">
            <?php if ($model->evidence_id == null): ?>
                <a href="#" class="btn btn-success">Registrar Avance</a>
            <?php else: ?>
                <a href="#">Editar Avance</a>
            <?php endif; ?>
        </div>
    </div>
</div>
