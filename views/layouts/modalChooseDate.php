<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 21/02/2016
 * Time: 10:51 PM
 */
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use kartik\field\FieldRange;
use yii\helpers\Html;
use app\models\Registration;
use yii\helpers\Url;

Modal::begin([
    'id'=>'modalChooseDate',
    'header' => '<h2>Selecciona las fechas para la realización de tu servicio social</h2>',
]);

$model = new Registration();

$form = ActiveForm::begin([
    'action' =>Url::to(['/student/default/set-beginning-and-ending-dates'])
]);


?>



    <div class="input-group drp-container">

        <?= FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Ingrese rango de fechas',
            'separator' => ' al ',
            'attribute1' => 'beginning_date',
            'attribute2' => 'ending_date',
            'type' => FieldRange::INPUT_DATE,
            'widgetOptions1' => [
                'pluginOptions' => [
                    'daysOfWeekDisabled' => [0, 6],
                    'autoclose' => true,
                    'format' => 'yyyy-m-d'
                ]
            ],
            'widgetOptions2' => [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-m-d'
                ]
            ],
        ]); ?>
    </div>
    <br>
<?= Html::submitButton('Establecer fechas', [
    'class' => 'btn btn-success'
]) ?>
<?php ActiveForm::end();?>
<?php Modal::end();?>