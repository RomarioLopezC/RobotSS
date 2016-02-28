<?php
/**
 * Created by PhpStorm.
 * User: Vanessa
 * Date: 26/02/2016
 * Time: 08:48 PM
 */

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = /** @lang text */
    'Sistema de Servicio Social de la Universidad Autónoma de Yucatán';
?>
<div class="site-index">
    <div class="wide">
        <div class="row">
            <div class="col-xs-5 line"><hr></div>
            <div class="col-xs-2 logo"><?= Html::img(Url::to(['/images/uady-logo-small.jpg']),
                    ['class' => 'img-responsive center-block']) ?></div>
            <div class="col-xs-5 line"><hr></div>
        </div>
    </div>
    <div class="body-content center-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6">
                    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="col-xs-3"></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">
                        <?= Html::img(Url::to(['/images/slogan.jpg']), ['class' => 'img-responsive center-block']) ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>