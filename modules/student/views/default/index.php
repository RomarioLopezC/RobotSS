<?php

use app\models\Project;
use app\models\Registration;
use app\models\student;
use app\models\StudentEvidenceSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Página principal';
Yii::$app->formatter->locale = 'es_ES';

$student = Student::findOne(['user_id' => Yii::$app->user->id]);

if ($registration = Registration::findOne(['student_id' => $student->id])) {
    $project = Project::findOne($registration->project_id);
    $textProject = 'Avances de proyecto: ' . $project->name;

    $searchModel = new StudentEvidenceSearch();
    $dataProviderNews = $searchModel->search(Yii::$app->request->queryParams, \app\models\StudentEvidence::$NEW);
    $dataProviderPending = $searchModel->search(Yii::$app->request->queryParams, \app\models\StudentEvidence::$PENDING);

    $countNews = $dataProviderNews->getTotalCount();
    $countPending = $dataProviderPending->getTotalCount();

    if ($countNews == 1) {
        $textDetails = 'Tienes ' . $countNews . ' avance nuevo.';
    } else {
        $textDetails = 'Tienes ' . $countNews . ' avances nuevos.';
    }
    if ($countPending == 1) {
        $textDetails .= /** @lang text */
            '<br>Tienes ' . $countPending . ' avance pendiente.';
    } else {
        $textDetails .= /** @lang text */
            '<br>Tienes ' . $countPending . ' avances pendientes.';
    }
    $textFooter = /** @lang text */
        "<div class = 'panel-footer'><h4>Da click en el menú <i>Avances</i> para ver los detalles.</h4></div>";
} else {
    $textProject = 'No estás asignado a un proyecto';
    $textDetails = 'Inicia el preregistro a un proyecto disponible y espera a que el encargado del servicio social'.
        ' confirme tu asignación.';
    $textFooter = '';
}
?>
<div class="student-index">
    <div class="body-content center-block">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3><?= $textProject ?></h3>
            </div>

            <div class="panel-body">
                <p><?= $textDetails ?></p>
            </div>
            <?= $textFooter ?>
        </div>
    </div>
</div>
