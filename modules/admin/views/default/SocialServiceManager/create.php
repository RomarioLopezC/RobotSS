<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SocialServiceManager */

$this->title = 'Registro de Encargado del Servicio Social';
$this->params['breadcrumbs'][] = ['label' => 'Administrador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-create">


    <?= $this->render('_form', [
        'socialServiceManager' => $socialServiceManager,
        'user'=>$user
    ]) ?>

</div>
