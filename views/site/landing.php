<?php
/**
 * Created by PhpStorm.
 * User: nezzi
 * Date: 26/02/2016
 * Time: 08:48 PM
 */

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Sistema de Servicio Social de la Universidad Autónoma de Yucatán';
?>
<div class="site-index">
    <div class="body-content center-block">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::img(Url::to(['/images/uady-logo.jpg']), ['class' => 'img-responsive center-block']) ?>
        </p>
    </div>
</div>