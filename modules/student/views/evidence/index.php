<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EvidenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evidence-index">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <p>
        <?= Html::a('Imprimir reporte de avances', [''], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <br><br><br>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Nuevos</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'attachment_path',
                    'description:ntext',
                    'status',
                    'accepted_date',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
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
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'attachment_path',
                    'description:ntext',
                    'status',
                    'accepted_date',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
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
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'attachment_path',
                    'description:ntext',
                    'status',
                    'accepted_date',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

</div>
