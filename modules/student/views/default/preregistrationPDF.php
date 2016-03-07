<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 13/02/2016
 * Time: 07:54 PM
 */
use app\models\Person;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-xs-2">
        <?= Html::img (Url::to (['/images/uady-logo.jpg'])) ?>
    </div>
    <div class="col-xs-6 center-block">
        <h4 class="text-center" style="font-weight: bold">Universidad Autónoma de Yucatán</h4>
        <p class="text-center">Direccion General de Desarrollo Academico<br>Sistema de Atencion Integral al
            Estudiante<br>Programa
            Institucional de Servicio Social</p>
    </div>
</div>
<h3 class="text-center" style="font-weight: bold; margin: 2em 0">HOJA DE PRE-REGISTRO</h3>

<?php
$formatter = \Yii::$app->formatter;
?>
<p class="text-right">
    <?= 'Mérida, Yucatán a ' . $formatter->asDate (date ('Y-m-d'), 'long'); ?>
</p>
<div class="row">
    <h4 class="text-center" style="margin: 2em 0">DATOS DEL PRESTADOR</h4>
    <div class="col-xs-3 col-xs-offset-1">
        <strong>Matricula:</strong><br>
        <strong>Nombre Completo:</strong><br>
        <strong>Carrera:</strong><br>
        <strong>Correo electronico:</strong>
        <strong>Teléfono:</strong>
    </div>
    <div class="col-xs-5">
        <?= $student->enrollment_id ?><br>
        <?= $person->name . ' ' . $person->lastname ?><br>
        <?= $degree->name ?><br>
        <?= $user->email ?><br>
        <?= $person->phone ?><br>
    </div>
</div>

<div class="row">
    <h4 class="text-center" style="margin: 2em 0">DATOS DEL PROYECTO</h4>
    <div class="col-xs-4 col-xs-offset-1">
        <strong>Número y Nombre:</strong><br>
        <strong>Responsable del proyecto:</strong><br>
    </div>
    <div class="col-xs-5">
        <?= $project->id . ' - ' . $project->name ?><br>
        <?= Person::findOne (\app\models\User::findOne ($projectM->user_id)->person_id)->name . ' ' .
        Person::findOne (\app\models\User::findOne ($projectM->user_id)->person_id)->lastname ?>
        <br>
    </div>
</div>

<div class="row" style="margin: 9em 0 7em 0">
    <div class="col-xs-5 center-block">
        <p class="text-center">Firma y Sello</p>
        <p class="text-center" style="margin: 1.4em 0">______________________________</p>
    </div>
</div>