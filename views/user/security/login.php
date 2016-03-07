<?php
use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t ('user', 'Iniciar sesión');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render ('/_alert', ['module' => Yii::$app->getModule ('user')]) ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode ($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin ([
                    'id' => 'login-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                ]) ?>

                <?= $form->field ($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus',
                    'class' => 'form-control', 'tabindex' => '1']])->label (Yii::t ('user', 'Usuario')) ?>

                <?= $form->field ($model, 'password', ['inputOptions' => ['class' => 'form-control',
                    'tabindex' => '2']])->passwordInput ()->label (Yii::t ('user', 'Contraseña') .
                    ($module->enablePasswordRecovery ? ' (' . Html::a (Yii::t ('user', 'Recuperar contraseña'),
                            ['/user/recovery/request'], ['tabindex' => '5']) . ')' : '')) ?>

                <?= Html::submitButton (Yii::t ('user', 'Ingresar'), ['class' => 'btn btn-primary btn-block',
                    'tabindex' => '3']) ?>

                <?php ActiveForm::end (); ?>
            </div>
        </div>
        <?php if ($module->enableConfirmation): ?>
            <p class="text-right">
                <?= Html::a (Yii::t ('user', '¿No recibiste el correo de confirmación?'),
                    ['/user/registration/resend']) ?>
            </p>
        <?php endif ?>
        <?php if ($module->enableRegistration): ?>
            <p class="text-right">
                <?= Html::a (Yii::t ('user', '¿Eres alumno y no tienes una cuenta?'),
                    ['/student/default/create']) ?>
            </p>
        <?php endif ?>
        <?php if ($module->enableRegistration): ?>
            <p class="text-right">
                <?= Html::a (Yii::t ('user', '¿Quieres registrar tu proyecto y no tienes una cuenta?'),
                    ['/site/project-manager-request']) ?>
            </p>
        <?php endif ?>
        <?= Connect::widget ([
            'baseAuthUrl' => ['/user/security/auth']
        ]) ?>
    </div>
</div>