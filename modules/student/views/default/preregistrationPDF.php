<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 13/02/2016
 * Time: 07:54 PM
 */
use yii\bootstrap\Html;
use yii\helpers\Url;
use app\models\Student;
use app\models\Person;
use app\models\Degree;
use app\models\Project;

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
<h3 class="text-center" STYLE="font-weight: bold">CARTA DE PREREGISTRO</h3>


<div class="row">
    <h4 class="text-center" style="margin: 2em 0">DATOS DEL PRESTADOR</h4>
    <div class="col-xs-3 col-xs-offset-1">
        <strong>Matricula:</strong><br>
        <strong>Nombre Completo:</strong><br>
        <strong>Facultad:</strong><br>
        <strong>Plan de Estudio:</strong>
    </div>
    <div class="col-xs-5">
        <?= $student->enrollment_id ?><br>
        <?= $person->name .' '. $person->lastname ?><br>
        <?= $student->getFaculty()->all()[0]['name'] ?><br>
        <?= $degree->name ?><br>
    </div>
</div>


<div class="row">
    <h4 class="text-center" style="margin: 2em 0">DATOS DEL PROYECTO</h4>
    <div class="col-xs-3 col-xs-offset-1">
        <strong>Nombre:</strong><br>
        <strong>Periodo de prestación:</strong><br>
        <strong>Ayuda Económica:</strong><br>
        <strong>Monto:</strong><br>
        <strong>Duración (Hrs.):</strong>
    </div>
    <div class="col-xs-5">
        <?= $project->name ?><br>
        <?= 'Inicia: ' . date('d') . '/' . date('m') . '/' . date('Y') .
        ' - Finaliza: ' . date('d') . '/0' . ((int)date('m') + 6) . '/' . date('Y') ?> <br>
        <?= $project->economic_support ?><br>
        <?= $project->ammount ?><br>
        <?= '480' ?><br>
    </div>
</div>

<div class="row">
    <h4 class="text-center" style="margin: 2em 0">DATOS DE LA INSTITUCIÓN</h4>
    <div class="col-xs-4 col-xs-offset-1">
        <strong>Nombre:</strong><br>
        <strong>Unidad Receptora:</strong><br>
        <strong>Responsable del Proyecto:</strong><br>
        <strong>Responsable del Prestador:</strong><br>
    </div>
    <div class="col-xs-4">
        <?= $projectM->organization ?><br>
        <?= $project->dependency ?><br>
        <?= Person::findOne(\app\models\User::findOne($projectM->user_id)->person_id)->name . ' ' .
        Person::findOne(\app\models\User::findOne($projectM->user_id)->person_id)->lastname ?>
        <br>
        <?= Person::findOne(\app\models\User::findOne($projectM->user_id)->person_id)->name . ' ' .
        Person::findOne(\app\models\User::findOne($projectM->user_id)->person_id)->lastname ?>
        <br>
    </div>
</div>

<div class="row" style="margin: 9em 0 0 0">
    <div class="col-xs-5">
        <p class="text-center">Firma y Sello</p>
        <p class="text-center" style="margin: 1.4em 0">_________________________</p>
    </div>
    <div class="col-xs-5">
        <p class="text-center">Firma</p>
        <p class="text-center" style="margin: 1.4em 0">_________________________</p>
    </div>
</div>
