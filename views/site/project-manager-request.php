<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 30/01/2016
 * Time: 11:16 AM
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Solicitud de Cuenta';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-3">
            <?= Html::img('../images/uady-logo.jpg', ['class' => 'img-responsive']) ?>
        </div>

        <div class="col-lg-7">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Datos Generales</h4>
                </div>

                <div class="panel-body">

                <?php $form = ActiveForm::begin([
                    'id' => 'project-manager-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-10\">{input}{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-2 control-label'],
                    ],
                ]); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'lastName') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'organization') ?>

                </div>
            </div>

            <div class="form-group">
                <div class="pull-right">
                    <?= Html::a('Cancelar', '#', ['class' => 'btn btn-danger']) ?>
                    <?= Html::submitButton('Completar Solicitud', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

