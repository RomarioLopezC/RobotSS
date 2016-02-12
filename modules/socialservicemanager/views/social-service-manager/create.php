<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SocialServiceManager */

$this->title = 'Registrar Encargado de Servicio Social';
$this->params['breadcrumbs'][] = ['label' => 'Social Service Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-create">

    <div class="well well-sm">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
