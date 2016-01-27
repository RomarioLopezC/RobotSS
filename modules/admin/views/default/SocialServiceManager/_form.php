<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;

/* @var $this yii\web\View */
/* @var $model app\models\SocialServiceManager */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-service-manager-form">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'method'=>'POST',
                        'action'=>['create-social-service-manager'],
                        'enableAjaxValidation'   => true,
                        'enableClientValidation' => false,
                        //'layout' => 'horizontal'
                    ]); ?>

                    <?= $form->field($user, 'username')->textInput() ?>
                    <?= $form->field($user, 'password')->passwordInput() ?>
                    <?= $form->field($user, 'email')->textInput() ?>
                    <?= $form->field($socialServiceManager, 'faculty_id')->dropDownList(
                        ArrayHelper::map(Faculty::find()->all(), 'id', 'name')
                    ) ?>

                    <div class="form-group">
                        <?=Html::submitButton('Registrar',['class'=>'btn btn success'])?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
