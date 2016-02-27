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

<div class="row">
    <div class="col-xs-2">
        <?= Html::img(Url::to(['/images/uady-logo.jpg'])) ?>
    </div>
    <div class="col-xs-6 center-block">
        <h4 class="text-center" style="font-weight: bold">Universidad Autónoma de Yucatán</h4>
        <p class="text-center">Direccion General de Desarrollo Academico<br>Sistema de Atencion Integral al
            Estudiante<br>Programa
            Institucional de Servicio Social</p>
    </div>
</div>
<h3 class="text-center" style="font-weight: bold; margin: 2em 0">REPORTE DE AVANCES</h3>

<?php
$formatter = \Yii::$app->formatter;
?>
<div class="row">
    <div class="col-xs-4 col-xs-offset-1">
        <strong>Alumno:</strong><br>
    </div>
    <div class="col-xs-5">
        <?= $person->name .' '. $person->lastname ?><br>
    </div>
</div>

<div class="row">
    <div class="col-xs-4 col-xs-offset-1">
        <strong>Proyecto:</strong><br>
        <strong>Encargado de proyecto:</strong><br>
        <strong>Fecha de inicio:</strong><br>
        <strong>Fecha de término:</strong><br>
    </div>
    <div class="col-xs-5">
        <?= $project->name ?><br>
        <?= Person::findOne(\app\models\User::findOne($projectM->user_id)->person_id)->name . ' ' .
        Person::findOne(\app\models\User::findOne($projectM->user_id)->person_id)->lastname ?><br>
        <?= $registration->beginning_date ?><br>
        <?= $registration->ending_date ?><br>
    </div>
</div>

<div class="row text-center">
    <h3 style="font-weight: bold; margin: 2em 0">Lista de avances completados</h3>
</div>
<div class="panel-body">

    <?= GridView::widget([
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