<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use kartik\tabs\TabsX;
use dektrium\user\models\SettingsForm;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Perfil',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="person-update">

    <div class="well well-sm">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php
    $account = \Yii::createObject(SettingsForm::className());
    foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-' . $key,
            ],
            'body' => $message,
        ]);
    }
    ?>

    <?= TabsX::widget([
        'items' => [
            [
                'label' => '<i class="glyphicon glyphicon-user"></i> Editar información de cuenta',
                'content' => $this->render('_form', [
                    'model' => $model,
                    'user' => $user,
                    'rol' => $rol
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-cog"></i> Editar usuario y contraseña',
                'content'=>$this->render('changePassword',[
                    'model'=>$account
                ])
            ]
        ],
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false
    ]); ?>



</div>
