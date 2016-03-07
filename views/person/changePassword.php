<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 13/02/2016
 * Time: 03:12 AM
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="col-lg-7 col-lg-offset-3">
    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Modificar usuario y contraseña</h4>
        </div>

        <div class="panel-body">
            <?php $form = ActiveForm::begin ([
                'id' => 'account-form',
                'options' => ['class' => 'form-horizontal'],
                'action' => ['change-password', 'id' => Yii::$app->user->id],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n
                                            <div class=\"col-sm-offset-3 col-lg-9\">
                                                {error}\n{hint}
                                            </div>",
                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                ],
                //'enableAjaxValidation' => true,
                //'enableClientValidation' => false,
            ]); ?>


            <?= $form->field ($model, 'username') ?>

            <?= $form->field ($model, 'new_password')->passwordInput () ?>

            <hr/>

            <?= $form->field ($model, 'current_password')->passwordInput () ?>
        </div>

    </div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
            <?= Html::submitButton (Yii::t ('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?><br>
        </div>
    </div>

    <?php ActiveForm::end (); ?>
</div>
