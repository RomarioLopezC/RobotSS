<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Crear nuevo proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-4 col-lg-offset-2"></div>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
