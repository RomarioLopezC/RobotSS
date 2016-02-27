<?php

use app\models\Project;
use app\models\Registration;
use app\models\student;
use app\models\StudentEvidenceSearch;
use yii\base\InvalidConfigException;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Página principal';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->formatter->locale = 'es_ES';

$student = Student::findOne(['user_id' => Yii::$app->user->id]);
$textNews ='';
$textPending = '';
$textDetails = '';
if($registration = Registration::findOne(['student_id' => $student->id])){
    $project = Project::findOne($registration->project_id);
    $textProject = 'Avances de proyecto: '.$project->name;
    $searchModel = new StudentEvidenceSearch();
    $dataProviderNews = $searchModel->searchNews(Yii::$app->request->queryParams);
    $dataProviderPending = $searchModel->searchPending(Yii::$app->request->queryParams);
    $countNews = $dataProviderNews->getTotalCount();
    $countPending = $dataProviderPending->getTotalCount();
    if ($countNews==1){
        $textNews = 'Tienes '.$countNews.' avance nuevo.';
    } else{
        $textNews = 'Tienes '.$countNews.' avances nuevos.';
    }
    if ($countPending==1){
        $textPending = 'Tienes '.$countPending.' avance pendiente.';
    } else{
        $textPending = 'Tienes '.$countPending.' avances pendientes.';
    }
    $textDetails = /** @lang text */
        "<div class = 'panel-footer'><h4>Da click en el menú <i>Avances</i> para ver los detalles.</h4></div>";
}else{
    $textProject = /** @lang text */
        'No estás asignado a un proyecto.</br>Inicia el preregistro a un proyecto disponible y'.
    ' espera a que el encargado del servicio social confirme tu asignación.';
}
?>
<div class="student-index">
    <div class="body-content center-block">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3><?= $textProject?></h3>
            </div>

            <div class="panel-body">
                <p><?=$textNews?></p>
                <p><?=$textPending?></p>
            </div>
            <?=$textDetails?>
        </div>
    </div>
</div>
