<?php

use app\models\Faculty;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SocialServiceManager */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-service-manager-form">

    <div class="row">
        <div class="col-lg-3">
            <?= Html::img(Url::to(['/images/uady-logo.jpg']), ['class' => 'img-responsive']) ?>
        </div>

        <div class="col-lg-7">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Datos Generales</h4>
                </div>

                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput() ?>
                    <?= $form->field($model, 'lastName')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput() ?>
                    <?= $form->field($model, 'phone')->textInput() ?>
                    <?= $form->field($model, 'username')->textInput() ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'faculty_id')->dropDownList(
                        ArrayHelper::map(Faculty::find()->all(), 'id', 'name')
                    ) ?>
                </div>
            </div>
            <div class="form-group pull-right">
                <?= Html::submitButton($model->isNewRecord ? 'Completar Registro' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
