<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentEvidenceSearch */
/* @var $dataProviderNews yii\data\ActiveDataProvider */
/* @var $dataProviderPending yii\data\ActiveDataProvider */
/* @var $dataProviderAccepted yii\data\ActiveDataProvider */

$this->title = 'Avances';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->formatter->locale = 'es_ES';

?>
<div class="student-evidence-index">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <p>
        <?= Html::a('Imprimir reporte de avances', ['print-evidence-report'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <br><br><br>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Nuevos</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProviderNews,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'task_name',
                        'value' => 'task.name',
                    ],
                    [
                        'attribute' => 'task_delivery_date',
                        'value' => 'task.delivery_date',
                        'format' => 'date',
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
                ],
            ]); ?>

        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Pendientes</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProviderPending,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'task_name',
                        'value' => 'task.name',
                    ],
                    [
                        'attribute' => 'evidence_updated_at',
                        'value' => 'evidence.updated_at',
                        'format' => 'date',
                    ],
                    [
                        'attribute' => 'task_delivery_date',
                        'value' => 'task.delivery_date',
                        'format' => 'date',
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
                ],
            ]); ?>

        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Completados</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProviderAccepted,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'task_name',
                        'value' => 'task.name',
                    ],
                    [
                        'attribute' => 'evidence_accepted_date',
                        'value' => 'evidence.accepted_date',
                        'format' => 'date',
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
                ],
            ]); ?>

        </div>
    </div>


</div>
