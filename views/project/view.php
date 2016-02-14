<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Búsqueda de Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <p><b>Nombre del Proyecto: </b> <?= $model->name ?></p>
        </div>

        <div class="col-lg-6">
            <p><b>Dependencia Solicitante: </b> <?= $model->dependency ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Prefiles Solicitados: </b></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Objetivos del Proyecto: </b> <?= $model->objective ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Meta(s) del Proyecto: </b> <?= $model->goals ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Acciones a realizar por los prestadores: </b> <?= $model->actions_by_students ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Inducción: </b> <?= $model->induction ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><b>Recursos con los que dispondrá el prestador: </b> <?= $model->economic_support ?> </p>
        </div>
    </div>

</div>
