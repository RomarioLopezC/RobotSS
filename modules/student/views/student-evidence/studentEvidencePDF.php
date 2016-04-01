<?php
/**
 * Created by PhpStorm.
 * User: Vanessa
 * Date: 27/02/2016
 * Time: 12:54 AM
 */
use app\models\Person;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;

Yii::$app->formatter->locale = 'es_ES';
?>
<div class="wide">
    <?= Html::img (Url::to (['/images/uady-pdf.jpg']), ['class' => 'img-responsive']) ?>
</div>
<div class="row">
    <h3 class="text-center" style="font-weight: bold;">REPORTE DE AVANCES</h3><br>
</div>

<?php
$formatter = \Yii::$app->formatter;
?>
<div class="row">
    <div class="col-xs-2 col-xs-offset-1">
        <strong>Alumno:</strong><br>
    </div>
    <div class="col-xs-2">
        <?= $person->name . ' ' . $person->lastname ?><br>
    </div>
    <div class="col-xs-2">
        <strong>Fecha inicio:</strong><br>
    </div>
    <div class="col-xs-2">
        <?= Yii::$app->formatter->asDate ($registration->beginning_date, 'php: d/F/Y') ?><br>
    </div>
</div>

<div class="row">
    <div class="col-xs-2 col-xs-offset-1">
        <strong>Proyecto:</strong><br>
    </div>
    <div class="col-xs-2">
        <?= $project->name ?><br>
    </div>
    <div class="col-xs-2">
        <strong>Fecha término:</strong><br>
    </div>
    <div class="col-xs-2">
        <?= Yii::$app->formatter->asDate ($registration->ending_date, 'php: d/F/Y') ?><br>
    </div>
</div>

<div class="row">
    <div class="col-xs-2 col-xs-offset-1">
        <strong>Responsable de proyecto:</strong><br>
    </div>
    <div class="col-xs-2">
        <?= Person::findOne (\app\models\User::findOne ($projectM->user_id)->person_id)->name . ' ' .
        Person::findOne (\app\models\User::findOne ($projectM->user_id)->person_id)->lastname ?><br><br>
    </div>
</div>
<br><br>
<div class="panel panel-default">
    <div class="panel-heading center-block">
        <h4 class="text-center" style="font-weight: bold;">Lista de avances completados</h4>
    </div>
    <div class="panel-body">
        <?= GridView::widget ([
            'dataProvider' => $dataProviderAccepted,
            'columns' => [
                [
                    'attribute' => 'task_name',
                    'value' => 'task.name',
                ],
                [
                    'attribute' => 'evidence_accepted_date',
                    'value' => 'evidence.accepted_date',
                    'format' => 'date',
                ],
                [
                    'attribute' => 'task_description',
                    'value' => 'task.description',
                ],
            ],
        ]); ?>
    </div>
</div>