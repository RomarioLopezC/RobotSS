<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SocialServiceManager */

$this->title = 'Create Social Service Manager';
$this->params['breadcrumbs'][] = ['label' => 'Social Service Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-create">

    <h1><?= Html::encode ($this->title) ?></h1>

    <?= $this->render ('_form', [
        'model' => $model,
    ]) ?>

</div>
