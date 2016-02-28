<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = 'Crear nueva petición';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode ($this->title) ?></h1>
    <?php
    foreach (Yii::$app->getSession ()->getAllFlashes () as $key => $message) {
        echo Alert::widget ([
            'options' => [
                'class' => 'alert-' . $key,
            ],
            'body' => $message,
        ]);
    }
    ?>

    <?= $this->render ('_form', [
        'model' => $model,
        'project_id' => $project_id,
    ]) ?>


</div>
